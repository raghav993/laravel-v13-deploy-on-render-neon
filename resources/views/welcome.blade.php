@extends('layouts.app')

@section('title', 'Sahayika — घर की मदद और Local Workers')
@section('meta_description', 'Sahayika पर घरेलू सहायिका और local workers खोजें — electrician, carpenter, mistri, barber, laundry, massage और अन्य services.')

@section('content')
<section class="home-hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <div class="eyebrow"><span class="eyebrow-dot"></span> अब घर की मदद + Local Services, एक ही जगह</div>
            <h1>घर की मदद हो या कोई काम,<br><em>सही इंसान</em> आसानी से ढूंढें।</h1>
            <p class="hero-lead">Sahayika पर घरेलू सहायिका के साथ-साथ electrician, carpenter, mistri, plumber, barber, laundry, massage और दूसरे local professionals के profiles देखें और booking request भेजें।</p>
            <div class="hero-actions">
                <a href="{{ route('workers.index') }}" class="btn btn-primary">Local Worker खोजें <span>→</span></a>
                <a href="{{ route('workers.create') }}" class="btn btn-light">मैं काम करता/करती हूँ</a>
            </div>
            <div class="hero-trust"><span>✓</span> Profile में skills, experience और service area साफ दिखाई देता है</div>
        </div>
        <div class="hero-panel">
            <div class="hero-panel-top"><span>आपको किसकी जरूरत है?</span><span class="live-dot">● Live</span></div>
            <div class="quick-search">
                <span>⌕</span><span>Electrician, Carpenter, Mistri...</span>
            </div>
            <div class="mini-categories">
                <a href="{{ route('workers.index', ['category'=>'electrician']) }}"><b>⚡</b>Electrician</a>
                <a href="{{ route('workers.index', ['category'=>'carpenter']) }}"><b>▱</b>Carpenter</a>
                <a href="{{ route('workers.index', ['category'=>'mason']) }}"><b>◈</b>Mistri</a>
                <a href="{{ route('workers.index', ['category'=>'iron']) }}"><b>♨</b>Laundry</a>
                <a href="{{ route('workers.index', ['category'=>'massage']) }}"><b>✦</b>Massage</a>
                <a href="{{ route('workers.index', ['category'=>'barber']) }}"><b>✂</b>Barber</a>
            </div>
            <div class="hero-card-preview">
                <div class="avatar avatar-blue">RK</div>
                <div><strong>Rakesh Kumar</strong><span>Electrician · 6 yrs experience</span><small>Available • Indore</small></div>
                <span class="arrow-circle">→</span>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div><span class="eyebrow">Sahayika का नया हिस्सा</span><h2>Local Workers Marketplace</h2></div>
            <a href="{{ route('workers.index') }}" class="text-link">सभी workers देखें →</a>
        </div>
        <div class="feature-grid">
            <article class="feature-card feature-blue"><span class="feature-icon">⌕</span><h3>काम के हिसाब से खोजें</h3><p>Category, city और area के आधार पर relevant local professionals तक जल्दी पहुंचें।</p></article>
            <article class="feature-card feature-green"><span class="feature-icon">◎</span><h3>Profile पहले समझें</h3><p>Skills, experience, service type और availability देखकर decision लें।</p></article>
            <article class="feature-card feature-orange"><span class="feature-icon">↗</span><h3>सीधी booking request</h3><p>अपना समय, address और काम की जरूरत भेजकर service request शुरू करें।</p></article>
        </div>
    </div>
</section>

@if($featuredWorkers->isNotEmpty())
<section class="section section-soft">
    <div class="container">
        <div class="section-head"><div><span class="eyebrow">आज उपलब्ध profiles</span><h2>अपने काम के लिए कोई ढूंढ रहे हैं?</h2></div><a href="{{ route('workers.index') }}" class="text-link">View all →</a></div>
        <div class="worker-grid">
            @foreach($featuredWorkers as $worker)
                @include('local-workers._card', ['worker' => $worker])
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section">
    <div class="container how-section">
        <div class="how-intro"><span class="eyebrow">Simple process</span><h2>काम तय करना अब आसान है।</h2><p>Customer को पहले profile समझने और फिर request भेजने का साफ, simple flow मिलता है।</p></div>
        <div class="steps">
            <div><span>01</span><strong>काम बताएं</strong><p>किस service की जरूरत है, चुनें।</p></div>
            <div><span>02</span><strong>Profile देखें</strong><p>Experience और area compare करें।</p></div>
            <div><span>03</span><strong>Booking भेजें</strong><p>Date, time और address दें।</p></div>
            <div><span>04</span><strong>काम तय करें</strong><p>Request के बाद worker से confirmation लें।</p></div>
        </div>
    </div>
</section>

<section class="join-banner">
    <div class="container join-inner">
        <div><span class="eyebrow light">आप भी service देते हैं?</span><h2>अपना काम Sahayika पर दिखाइए।</h2><p>Carpenter, electrician, mistri, barber, laundry या कोई भी listed local service — अपना professional profile बनाएं।</p></div>
        <a href="{{ route('workers.create') }}" class="btn btn-white">अपना Profile बनाएं <span>→</span></a>
    </div>
</section>
@endsection
