<?php

namespace App\Http\Controllers;

use App\Models\LocalWorker;
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

    public function index(Request $request)
    {
        $query = LocalWorker::query();

        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('city', 'like', "%{$q}%")
                    ->orWhere('area', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category') && array_key_exists($request->category, self::CATEGORIES)) {
            $query->where('category', $request->category);
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%'.trim($request->city).'%');
        }

        if ($request->boolean('available')) {
            $query->where('availability_status', 'available');
        }

        $workers = $query->orderByRaw("CASE WHEN availability_status = 'available' THEN 0 ELSE 1 END")
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('local-workers.index', [
            'workers' => $workers,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function create()
    {
        return view('local-workers.create', ['categories' => self::CATEGORIES]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
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
        ]);

        $data['skills'] = collect(explode(',', $data['skills'] ?? ''))
            ->map(fn ($skill) => trim($skill))
            ->filter()
            ->values()
            ->all();

        $data['availability_status'] = 'available';
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
        return view('local-workers.show', compact('localWorker'));
    }
}
