<?php

namespace App\Http\Controllers;

use App\Models\LocalWorker;
use App\Models\WorkerFavorite;
use App\Models\WorkerRecentView;
use App\Http\Requests\StoreLocalWorkerRequest;
use App\Services\LocalWorkerMarketplaceService;
use Illuminate\Http\Request;

class LocalWorkerController extends Controller
{
    public const CATEGORIES = [
        'carpenter' => 'Carpenter',
        'mason' => 'Mistri / Mason',
        'iron' => 'Ironing & Laundry',
        'massage' => 'Massage',
        'barber' => 'Barber / Nai',
        'electrician' => 'Electrician',
        'plumber' => 'Plumber',
        'painter' => 'Painter',
        'cleaning' => 'Cleaning',
        'cook' => 'Cook',
    ];

    public function index(Request $request, LocalWorkerMarketplaceService $marketplace)
    {
        $query = $marketplace->search($request);

        if (false && $request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%")
                    ->orWhere('area', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            });
        }

        if (false && $request->filled('category') && array_key_exists($request->category, self::CATEGORIES)) {
            $query->where('category', $request->category);
        }

        if (false && $request->filled('city')) {
            $query->where('city', 'like', '%'.trim($request->city).'%');
        }

        if (false && $request->boolean('available')) {
            $query->where('availability_status', 'available');
        }

        $workers = $query->paginate(12)
            ->withQueryString();

        return view('local-workers.index', [
            'workers' => $workers,
            'categories' => self::CATEGORIES,
            'cities' => LocalWorker::select('city')->distinct()->orderBy('city')->pluck('city'),
            'areas' => LocalWorker::whereNotNull('area')->select('area')->distinct()->orderBy('area')->pluck('area'),
        ]);
    }

    public function create()
    {
        return view('local-workers.create', ['categories' => self::CATEGORIES]);
    }

    public function store(StoreLocalWorkerRequest $request)
    {
        $data = $request->validated(); /*
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'category' => ['required', 'in:'.implode(',', array_keys(self::CATEGORIES))],
            'skills' => ['nullable', 'string', 'max:500'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'city' => ['required', 'string', 'max:100'],
            'area' => ['nullable', 'string', 'max:120'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:60'],
            'service_type' => ['required', 'in:full_time,part_time,on_demand'],
            'hourly_rate' => ['nullable', 'numeric', 'min:0', 'max:999999'],
        ]); */

        $data['skills'] = collect(explode(',', $data['skills'] ?? ''))
            ->map(fn ($skill) => trim($skill))
            ->filter()
            ->values()
            ->all();

        $data['availability_status'] = 'available';
        foreach (['languages', 'certifications'] as $field) $data[$field] = collect(explode(',', $data[$field] ?? ''))->map(fn ($value) => trim($value))->filter()->values()->all();
        $data['avatar_color'] = collect(['#1d4ed8', '#0f766e', '#7c3aed', '#c2410c', '#be123c'])->random();

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        $worker = LocalWorker::create($data);

        return redirect()->route('workers.show', $worker)
            ->with('success', 'Profile created successfully. Customers can now discover your services.');
    }

    public function show(LocalWorker $localWorker)
    {
        $isSaved = false;
        if (auth()->check()) { WorkerRecentView::updateOrCreate(['user_id'=>auth()->id(),'local_worker_id'=>$localWorker->id]); $isSaved=WorkerFavorite::where(['user_id'=>auth()->id(),'local_worker_id'=>$localWorker->id])->exists(); }
        $similarWorkers=LocalWorker::where('category',$localWorker->category)->where('city',$localWorker->city)->whereKeyNot($localWorker->id)->orderByDesc('rating')->latest()->take(3)->get();
        return view('local-workers.show', compact('localWorker','similarWorkers','isSaved'));
    }
    public function favorite(LocalWorker $localWorker) { WorkerFavorite::firstOrCreate(['user_id'=>auth()->id(),'local_worker_id'=>$localWorker->id]); return back()->with('success','Worker saved to your shortlist.'); }
    public function unfavorite(LocalWorker $localWorker) { WorkerFavorite::where(['user_id'=>auth()->id(),'local_worker_id'=>$localWorker->id])->delete(); return back()->with('success','Worker removed from your shortlist.'); }
    public function report(Request $request, LocalWorker $localWorker) { $data=$request->validate(['reason'=>'required|string|max:100','details'=>'nullable|string|max:1000']); \DB::table('worker_reports')->insert(['user_id'=>auth()->id(),'local_worker_id'=>$localWorker->id,'reason'=>$data['reason'],'details'=>$data['details']??null,'created_at'=>now(),'updated_at'=>now()]); return back()->with('success','Thank you. Our safety team will review this report.'); }
}
