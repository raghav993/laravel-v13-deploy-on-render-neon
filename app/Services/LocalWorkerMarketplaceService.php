<?php

namespace App\Services;

use App\Models\LocalWorker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LocalWorkerMarketplaceService
{
    public function search(Request $request): Builder
    {
        $query = LocalWorker::query();
        if ($q = trim((string) $request->input('q'))) $query->where(fn (Builder $b) => $b->where('name', 'like', "%{$q}%")->orWhere('city', 'like', "%{$q}%")->orWhere('area', 'like', "%{$q}%")->orWhere('category', 'like', "%{$q}%")->orWhereJsonContains('skills', $q));
        foreach (['category', 'city'] as $field) if ($request->filled($field)) $query->where($field, $field === 'city' ? 'like' : '=', $field === 'city' ? '%'.trim($request->$field).'%' : $request->$field);
        if ($request->filled('area')) $query->where('area', 'like', '%'.trim($request->area).'%');
        if ($request->filled('experience')) $query->where('experience_years', '>=', (int) $request->experience);
        if ($request->filled('min_rate')) $query->where('hourly_rate', '>=', $request->min_rate);
        if ($request->filled('max_rate')) $query->where('hourly_rate', '<=', $request->max_rate);
        if ($request->boolean('available')) $query->where('availability_status', 'available');
        if ($request->filled('gender')) $query->where('gender', $request->gender);
        return match ($request->input('sort')) {
            'rating' => $query->orderByDesc('rating')->orderByDesc('ratings_count'),
            'experience' => $query->orderByDesc('experience_years'),
            'newest' => $query->latest(),
            default => $query->orderByRaw("CASE WHEN availability_status = 'available' THEN 0 ELSE 1 END")->orderByDesc('is_verified')->latest(),
        };
    }
}
