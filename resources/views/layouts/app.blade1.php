<!doctype html>
<html lang="hi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sahayika — घर की मदद और Local Workers')</title>
    <meta name="description" content="@yield('meta_description', 'Sahayika पर घरेलू सहायिका और भरोसेमंद local workers जैसे electrician, carpenter, mistri, barber, laundry और massage professionals खोजें और booking request भेजें.')">
    <meta name="theme-color" content="#102a43">
</head>
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark">S</span>
            <span>Sahayika</span>
        </a>
        <nav class="main-nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('workers.index') }}" class="nav-switch active">Local Workers <span>↗</span></a>
            <a href="{{ route('workers.create') }}">काम के लिए रजिस्टर करें</a>
        </nav>
        <a class="nav-cta" href="{{ route('workers.index') }}">काम ढूंढें</a>
    </div>
</header>

<main>
    @if(session('success'))
        <div class="container flash-wrap">
            <div class="flash success"><span>✓</span>{{ session('success') }}</div>
        </div>
    @endif
    @if($errors->any())
        <div class="container flash-wrap">
            <div class="flash error"><span>!</span><div>{{ $errors->first() }}</div></div>
        </div>
    @endif
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <a href="{{ route('home') }}" class="brand footer-brand"><span class="brand-mark">S</span><span>Sahayika</span></a>
            <p>घर की मदद से लेकर रोज़मर्रा के local professionals तक — एक ही जगह।</p>
        </div>
        <div><strong>Local Workers</strong><a href="{{ route('workers.index') }}">Worker खोजें</a><a href="{{ route('workers.create') }}">अपना profile बनाएं</a></div>
        <div><strong>Services</strong><span>Electrician</span><span>Carpenter</span><span>Mistri</span><span>Laundry & more</span></div>
    </div>
    <div class="container footer-bottom">© {{ date('Y') }} Sahayika. Profiles and bookings are subject to availability.</div>
</footer>
</body>
</html>
