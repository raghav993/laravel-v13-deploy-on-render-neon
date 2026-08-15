@extends('layouts.app')
@section('title', 'Booking request received — Sahayika')
@section('content')
<section class="section"><div class="container confirmation-card"><div class="confirmation-icon">✓</div><span class="eyebrow">REQUEST RECEIVED</span><h1>Your booking request is on its way.</h1><p>{{ $localWorker->name }} will review your preferred date and time. We’ll keep this request visible in your booking history.</p><div class="booking-timeline"><div class="active"><b>1</b><span>Request sent<br><small>{{ $booking->created_at->format('d M, h:i A') }}</small></span></div><div><b>2</b><span>Worker review</span></div><div><b>3</b><span>Service confirmed</span></div></div><a class="btn btn-primary" href="{{ route('workers.show',$localWorker) }}">Return to profile</a></div></section>
@endsection
