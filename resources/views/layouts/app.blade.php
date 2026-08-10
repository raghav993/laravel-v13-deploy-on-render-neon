<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteSettings['site_name']->value ?? 'Sahayika' }} — {{ $siteSettings['tagline']->value ?? 'भरोसेमंद घरेलू मदद' }}</title>
    <meta name="description" content="अपने शहर में घर के काम, बर्तन-झाड़ू, खाना बनाने, कपड़े धोने, बेबी केयर और बुज़ुर्गों की देखभाल के लिए सहायिका खोजें। प्रोफाइल देखें, अनुभव जानें और सीधे संपर्क करें — Sahayika पर।">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;0,9..144,900;1,9..144,500&family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    @if(session('success'))<div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}<button class="btn-close" data-bs-dismiss="alert"></button></div>@endif
    <main>@yield('content')</main>
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