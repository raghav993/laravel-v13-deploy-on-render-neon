<?php

namespace App\Http\Controllers;

use App\Models\Locality;
use App\Models\LocalWorker;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index()
    {
        $featuredWorkers = LocalWorker::query()
            ->where('availability_status', 'available')
            ->latest()
            ->take(6)
            ->get();
        return view('index', [
            'searchServices' => Service::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'searchLocalities' => Locality::query()->whereHas('city', fn ($q) => $q->where('name', 'Indore'))->orderBy('name')->get(['id', 'name']),
            'featuredWorkers' => $featuredWorkers
        ]);
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function show(string $id)
    {
        //
    }

 
    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
