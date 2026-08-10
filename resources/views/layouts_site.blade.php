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
    <header id="siteHeader">
        <div class="wrap nav">
            <a href="/" class="brand">
                <img src="{{ isset($siteSettings['logo']) ? asset('storage/'.$siteSettings['logo']->value) : asset('assets/img/sahayika.png') }}" alt="Sahayika" width="170px">
            </a>
            <nav class="nav-links">
                <a href="/#services">सेवाएं</a>
                <a href="/#how">कैसे काम करता है</a>
                <a href="/#why">क्यों Sahayika</a>
                <a href="/#become">सहायिका बनें</a>
            </nav>
            <div class="nav-actions">
                @auth
                @php
                $user = auth()->user();

                $dashboardRoute = match ($user->role ?? 'customer') {
                'admin' => route('dashboard.index'),
                'helper', 'sahayika' => route('dashboard.index'),
                'customer' => route('dashboard.index'),
                default => route('dashboard.index'),
                };

                $avatar = $user->avatar ?? $user->profile_image ?? null;
                @endphp

                <a href="{{ $dashboardRoute }}" class="user-profile">
                    @if($avatar)
                    <img src="{{ asset('storage/' . $avatar) }}"
                        alt="{{ $user->name }}"
                        class="user-avatar">
                    @else
                    <span class="user-avatar user-avatar-placeholder">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                    @endif

                    <span class="user-name">{{ $user->name }}</span>
                </a>
                @else
                <a href="login" class="btn btn-ghost">लॉग इन</a>
                <a href="register" class="btn btn-primary">रजिस्टर करें</a>
                @endauth

            </div>
            <button class="menu-btn" onclick="document.getElementById('siteHeader').classList.toggle('open')" aria-label="Toggle menu">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M3 6h18M3 12h18M3 18h18" stroke="#16302E" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>
        <div class="mobile-panel">
            <a href="/#services">सेवाएं</a>
            <a href="/#how">कैसे काम करता है</a>
            <a href="/#why">क्यों Sahayika</a>
            <a href="/#become">सहायिका बनें</a>
            <a href="/login" class="btn btn-ghost">लॉग इन</a>
            <a href="/register" class="btn btn-primary">रजिस्टर करें</a>
        </div>
    </header>
    @if(session('success'))<div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}<button class="btn-close" data-bs-dismiss="alert"></button></div>@endif
    <main>@yield('content')</main>
    <footer>
        <div class="wrap">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/" class="brand">
                        <img src="{{ isset($siteSettings['logo']) ? asset('storage/'.$siteSettings['logo']->value) : asset('assets/img/light-logo.png') }}" alt="Sahayika" width="170px">
                    </a>
                    <p>अपने शहर में घर के काम, बच्चों और बुज़ुर्गों की देखभाल के लिए सहायिका खोजें — प्रोफाइल देखें, सीधे जुड़ें।</p>
                    <div class="socials">
                        <a href="/#" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="3" width="18" height="18" rx="5" stroke="#FBF5EA" stroke-width="1.6" />
                                <circle cx="12" cy="12" r="4" stroke="#FBF5EA" stroke-width="1.6" />
                            </svg></a>
                        <a href="/#" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M14 8H16V5H14C12 5 10.5 6.5 10.5 8.5V10H8.5V13H10.5V20H13.5V13H15.5L16 10H13.5V8.7C13.5 8.3 13.7 8 14 8Z" fill="#FBF5EA" />
                            </svg></a>
                        <a href="/#" aria-label="Twitter"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M4 4 L20 20 M20 4 L4 20" stroke="#FBF5EA" stroke-width="0" />
                                <path d="M21 5 C20.3 5.3 19.5 5.6 18.7 5.7 C19.6 5.1 20.2 4.3 20.5 3.3 C19.7 3.8 18.8 4.1 17.9 4.3 C17.1 3.5 16 3 14.8 3 C12.4 3 10.6 5.2 11.1 7.5 C7.7 7.3 4.7 5.7 2.7 3.1 C1.8 4.6 2.3 6.5 3.7 7.5 C3.1 7.5 2.5 7.3 2 7 C2 8.6 3.1 10 4.7 10.4 C4.2 10.5 3.6 10.6 3.1 10.4 C3.5 11.8 4.8 12.8 6.3 12.8 C5 13.8 3.4 14.3 1.7 14.2 C3.3 15.2 5.1 15.8 7 15.8 C14.8 15.8 18.7 9.4 18.5 5.6 C19.3 5.1 20 4.4 21 5 Z" fill="#FBF5EA" />
                            </svg></a>
                    </div>
                </div>
                <div class="footer-col">
                    <span class="label">सेवाएं</span>
                    <a href="/#services">घर की सफाई</a>
                    <a href="/#services">खाना बनाने वाली</a>
                    <a href="/#services">बच्चों की देखभाल</a>
                    <a href="/#services">बुज़ुर्गों की देखभाल</a>
                </div>
                <div class="footer-col">
                    <span class="label">कंपनी</span>
                    <a href="/#how">कैसे काम करता है</a>
                    <a href="/#become">सहायिका बनें</a>
                    <a href="/careers">Careers</a>
                    <a href="/contact">संपर्क करें</a>
                </div>
                <div class="footer-col">
                    <span class="label">अकाउंट</span>
                    <a href="/login">लॉग इन</a>
                    <a href="/register">रजिस्टर करें</a>
                    <a href="/help">Help Center</a>
                    <a href="/privacy">Privacy Policy</a>
                </div>
            </div>
            <div class="bottom">© 2026 Sahayika | साहायिका. · हर घर के लिए, भरोसेमंद मदद।</div>
        </div>
    </footer>
</body>

</html>