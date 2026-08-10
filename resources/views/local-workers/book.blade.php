@extends('layouts.app')

@section('title', 'Book '.$localWorker->name.' — Sahayika')

@section('content')
<section class="form-hero compact-hero"><div class="container"><span class="eyebrow">BOOKING REQUEST</span><h1>{{ $localWorker->name }} को booking request भेजें.</h1><p>{{ $localWorker->category_label }} · {{ $localWorker->city }}{{ $localWorker->area ? ' · '.$localWorker->area : '' }}</p></div></section>
<section class="section form-section"><div class="container booking-layout">
    <div class="form-card">
        <div class="form-title"><span class="step-badge">02</span><div><h2>Service details</h2><p>आपकी जरूरत के आधार पर worker को request भेजी जाएगी।</p></div></div>
        <form method="POST" action="{{ route('workers.book.store', $localWorker) }}" class="clean-form">
            @csrf
            <div class="field-grid">
                <label>Your name <input name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required></label>
                <label>Mobile number <input name="customer_phone" value="{{ old('customer_phone') }}" required inputmode="tel"></label>
                <label>Service date <input type="date" name="service_date" min="{{ now()->toDateString() }}" value="{{ old('service_date') }}" required></label>
                <label>Preferred time <select name="service_time" required><option value="">Select time</option><option>Morning · 8–11 AM</option><option>Afternoon · 12–3 PM</option><option>Evening · 4–7 PM</option><option>Flexible</option></select></label>
            </div>
            <label>Service address <textarea name="address" rows="3" required placeholder="House/Flat, street, locality, city">{{ old('address') }}</textarea></label>
            <label>काम की detail <textarea name="notes" rows="4" placeholder="जैसे fan installation, 2 switches repair, कपड़े press आदि">{{ old('notes') }}</textarea></label>
            <button class="btn btn-primary btn-wide">Booking Request भेजें <span>→</span></button>
        </form>
    </div>
    <aside class="booking-summary">
        <div class="summary-worker"><div class="avatar" style="--avatar: {{ $localWorker->avatar_color ?: '#1d4ed8' }}">{{ $localWorker->initials }}</div><div><strong>{{ $localWorker->name }}</strong><span>{{ $localWorker->category_label }}</span></div></div>
        <div class="summary-line"><span>Location</span><strong>{{ $localWorker->area ? $localWorker->area.', ' : '' }}{{ $localWorker->city }}</strong></div>
        <div class="summary-line"><span>Experience</span><strong>{{ $localWorker->experience_years }} years</strong></div>
        <div class="summary-line"><span>Rate</span><strong>{{ $localWorker->hourly_rate ? '₹'.number_format((float)$localWorker->hourly_rate).' / hr approx.' : 'On request' }}</strong></div>
        <p class="summary-warning">Booking request भेजना final confirmation नहीं है. Service scope, availability और charges worker के साथ confirm करें.</p>
    </aside>
</div></section>
@endsection
