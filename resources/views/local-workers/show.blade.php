@extends('layouts.app')

@section('title', $localWorker->name.' — '.$localWorker->category_label.' | Sahayika')

@section('content')
<section class="profile-top"><div class="container profile-breadcrumb"><a href="{{ route('workers.index') }}">Local Workers</a><span>/</span><span>{{ $localWorker->category_label }}</span></div></section>
<section class="section profile-section">
<div class="container profile-layout">
    <div class="profile-main-card">
        <div class="profile-head">
            <div class="avatar avatar-xl" style="--avatar: {{ $localWorker->avatar_color ?: '#1d4ed8' }}">{{ $localWorker->initials }}</div>
            <div class="profile-name"><span class="status-pill {{ $localWorker->availability_status }}"><i></i>{{ $localWorker->availability_label }}</span><h1>{{ $localWorker->name }}</h1><p>{{ $localWorker->category_label }} · {{ $localWorker->city }}</p></div>
        </div>
        <div class="profile-stats">
            <div><strong>{{ $localWorker->experience_years }}</strong><span>Years experience</span></div>
            <div><strong>{{ ucfirst(str_replace('_', ' ', $localWorker->service_type)) }}</strong><span>Service type</span></div>
            <div><strong>{{ $localWorker->area ?: 'City-wide' }}</strong><span>Service area</span></div>
        </div>
        <div class="profile-content">
            <div><span class="eyebrow">About</span><h2>काम और experience</h2><p>{{ $localWorker->bio ?: 'यह professional अपने listed category में local service provide करता/करती है। Booking से पहले अपनी जरूरत और pricing directly confirm करें।' }}</p></div>
            @if($localWorker->skills)<div><span class="eyebrow">Skills</span><div class="tags large">@foreach($localWorker->skills as $skill)<span>{{ $skill }}</span>@endforeach</div></div>@endif
        </div>
    </div>
    <aside class="booking-card">
        <span class="eyebrow">BOOK THIS PROFESSIONAL</span>
        <h2>{{ $localWorker->hourly_rate ? '₹'.number_format((float)$localWorker->hourly_rate).' / hour approx.' : 'Rate on request' }}</h2>
        <p>अपना date, time और address देकर booking request भेजें। Final price और availability को काम शुरू होने से पहले confirm करें।</p>
        @if($localWorker->availability_status !== 'unavailable')
            <a href="{{ route('workers.book', $localWorker) }}" class="btn btn-primary btn-wide">Booking Request भेजें <span>→</span></a>
        @else
            <button class="btn btn-disabled btn-wide" disabled>Currently unavailable</button>
        @endif
        <div class="booking-note">🔒 आपकी booking request इस profile के लिए दर्ज होगी।</div>
    </aside>
</div>
</section>
<section class="section section-soft"><div class="container"><div class="notice-card"><strong>Booking tip</strong><span>काम का scope, timing, charges और materials की responsibility पहले से clear कर लें।</span></div></div></section>
@endsection
