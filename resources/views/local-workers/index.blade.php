@extends('layouts.app')

@section('title', 'Local Workers — Sahayika')
@section('meta_description', 'अपने शहर में electrician, carpenter, mistri, plumber, painter, barber, laundry, massage और अन्य local workers खोजें.')

@section('content')
<section class="market-hero">
    <div class="container">
        <div class="market-hero-copy"><span class="eyebrow">SAHAYIKA • LOCAL WORKERS</span><h1>आपके काम के लिए<br><em>सही local professional.</em></h1><p>Service चुनें, अपने area में profile देखें और अपनी जरूरत के हिसाब से booking request भेजें।</p></div>
        <form class="search-box" method="GET" action="{{ route('workers.index') }}">
            <div class="search-field"><span>⌕</span><input name="q" value="{{ request('q') }}" placeholder="नाम, service या area search करें"></div>
            <div class="search-field city"><span>⌖</span><input name="city" value="{{ request('city') }}" placeholder="City"></div>
            <button class="btn btn-primary">Search</button>
        </form>
    </div>
</section>

<section class="section categories-section">
    <div class="container">
        <div class="section-head compact"><div><span class="eyebrow">Popular services</span><h2>किस काम के लिए चाहिए?</h2></div></div>
        <div class="category-scroll">
            <a class="category-chip {{ !request('category') ? 'selected' : '' }}" href="{{ route('workers.index') }}"><span>✦</span>All services</a>
            @foreach($categories as $key => $label)
                <a class="category-chip {{ request('category') === $key ? 'selected' : '' }}" href="{{ route('workers.index', ['category'=>$key, 'city'=>request('city')]) }}"><span>{{ match($key){'electrician'=>'⚡','carpenter'=>'▱','mason'=>'◈','iron'=>'♨','massage'=>'✦','barber'=>'✂','plumber'=>'⌁','painter'=>'◉','cleaning'=>'⌂','cook'=>'♨',default=>'•'} }}</span>{{ $label }}</a>
            @endforeach
        </div>
        <div class="filter-row">
            <div><strong>{{ $workers->total() }}</strong> profiles found @if(request('city')) in <strong>{{ request('city') }}</strong>@endif</div>
            <label class="check-filter"><input type="checkbox" form="availability-form" name="available" value="1" @checked(request('available')) onchange="this.form.submit()"> Available now</label>
            <form id="availability-form" method="GET" action="{{ route('workers.index') }}" hidden>
                @foreach(request()->except('available') as $key=>$value)<input type="hidden" name="{{ $key }}" value="{{ $value }}">@endforeach
            </form>
        </div>
        @if($workers->count())
            <div class="worker-grid">@foreach($workers as $worker) @include('local-workers._card', ['worker'=>$worker]) @endforeach</div>
            <div class="pagination">{{ $workers->links() }}</div>
        @else
            <div class="empty-state"><div>⌕</div><h3>इस search के लिए profile नहीं मिली</h3><p>Category या city बदलकर फिर try करें, या कोई local professional अपना profile register कर सकता है।</p><a class="btn btn-primary" href="{{ route('workers.create') }}">Register a worker</a></div>
        @endif
    </div>
</section>
@endsection
