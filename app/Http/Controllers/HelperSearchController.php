<?php

namespace App\Http\Controllers;

use App\Models\HelperProfile;
use App\Models\ContactRequest;
use App\Models\Locality;
use App\Models\Service;
use Illuminate\Http\Request;

class HelperSearchController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'service' => ['nullable', 'string', 'max:100'],
            'locality' => ['nullable', 'string', 'max:100'],
        ]);

        $service = null;
        if (!empty($validated['service'])) {
            $service = Service::where('slug', $validated['service'])
                ->where('is_active', true)
                ->first();
        }

        $locality = null;
        if (!empty($validated['locality'])) {
            $locality = Locality::query()
                ->where(function ($query) use ($validated) {
                    $query->where('name', 'like', '%' . $validated['locality'] . '%')
                        ->orWhere('pincode', 'like', '%' . $validated['locality'] . '%');
                })
                ->first();
        }

        $helpers = HelperProfile::query()
            ->with([
                'user:id,name',
                'locality.city:id,name',
                'services:id,service_category_id,name,name_hi,slug',
            ])
            ->active()
            ->when($service, fn($query) => $query->whereHas(
                'services',
                fn($services) => $services->whereKey($service->id)
            ))
            ->when($locality, fn($query) => $query->where('locality_id', $locality->id))
            ->orderByDesc('immediate_availability')
            ->orderByDesc('experience_years')
            ->paginate(12)
            ->withQueryString();

        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $localities = Locality::query()
            ->whereHas('city', fn($q) => $q->where('name', 'Indore'))
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('helpers.index', compact('helpers', 'services', 'localities', 'service', 'locality'));
    }

    public function show(HelperProfile $helperProfile)
    {
        abort_unless($helperProfile->profile_status === 'active', 404);

        $helperProfile->load([
            'user:id,name',
            'locality.city.state',
            'services.category',
            'availabilities' => fn($query) => $query->orderBy('day_of_week')->orderBy('start_time'),
        ]);

        $contactRequest = auth()->check() && auth()->user()->isCustomer()
            ? ContactRequest::where('customer_id', auth()->id())
                ->where('helper_profile_id', $helperProfile->id)
                ->first()
            : null;

        return view('helpers.show', compact('helperProfile', 'contactRequest'));
    }
}
