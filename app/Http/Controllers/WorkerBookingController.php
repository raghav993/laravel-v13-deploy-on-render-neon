<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LocalWorker;
use App\Models\WorkerBooking;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWorkerBookingRequest;

class WorkerBookingController extends Controller
{
    public function create(LocalWorker $localWorker)
    {
        abort_if($localWorker->availability_status === 'unavailable', 404);

        return view('local-workers.book', compact('localWorker'));
    }

    public function store(StoreWorkerBookingRequest $request, LocalWorker $localWorker)
    {
        abort_if($localWorker->availability_status === 'unavailable', 404);

        $data = $request->validated();

        $data['local_worker_id'] = $localWorker->id;
        $data['customer_user_id'] = auth()->id();
        $data['status'] = 'pending';

        $booking = WorkerBooking::create($data);

        return redirect()->route('workers.book.confirmation', [$localWorker, $booking]);
    }

    public function confirmation(LocalWorker $localWorker, WorkerBooking $booking) { abort_unless($booking->local_worker_id === $localWorker->id, 404); return view('local-workers.confirmation', compact('localWorker', 'booking')); }
}
