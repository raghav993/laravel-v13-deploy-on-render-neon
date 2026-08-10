<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LocalWorker;
use App\Models\WorkerBooking;
use Illuminate\Http\Request;

class WorkerBookingController extends Controller
{
    public function create(LocalWorker $localWorker)
    {
        abort_if($localWorker->availability_status === 'unavailable', 404);

        return view('local-workers.book', compact('localWorker'));
    }

    public function store(Request $request, LocalWorker $localWorker)
    {
        abort_if($localWorker->availability_status === 'unavailable', 404);

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'service_date' => ['required', 'date', 'after_or_equal:today'],
            'service_time' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $data['local_worker_id'] = $localWorker->id;
        $data['customer_user_id'] = auth()->id();
        $data['status'] = 'pending';

        $booking = WorkerBooking::create($data);

        return redirect()->route('workers.show', $localWorker)
            ->with('success', 'Booking request sent. The worker can review and confirm it.');
    }
}
