<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>सहायिका खोजें — Sahayika</title>
    <meta name="description" content="Indore में घरेलू काम, खाना, Baby Care और Elder Care के लिए सहायिका खोजें।">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #16302E;
            --paper: #FBF5EA;
            --gold: #E8A33D;
            --gold2: #C97F1F;
            --maroon: #A63446;
            --teal: #2F6E68;
            --card: #FFFDF8;
            --line: rgba(22, 48, 46, .12)
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: Inter, sans-serif
        }

        a {
            text-decoration: none;
            color: inherit
        }

        .wrap {
            max-width: 1180px;
            margin: auto;
            padding: 0 24px
        }

        header {
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(251, 245, 234, .94);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line)
        }

        nav {
            min-height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .brand {
            font: 700 1.45rem Fraunces, serif
        }

        .navlinks {
            display: flex;
            gap: 28px;
            font-size: .92rem
        }

        .navlinks a {
            opacity: .75
        }

        .navlinks a:hover {
            opacity: 1
        }

        .navbtn {
            padding: 10px 18px;
            border-radius: 99px;
            background: var(--ink);
            color: var(--paper);
            font-weight: 600
        }

        .hero {
            padding: 54px 0 34px;
            background: linear-gradient(180deg, #fffaf0 0%, var(--paper) 100%)
        }

        .eyebrow {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            color: var(--maroon);
            font: 600 .72rem 'Space Grotesk';
            letter-spacing: .13em;
            text-transform: uppercase
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--gold2)
        }

        h1 {
            font: 700 clamp(2rem, 4vw, 3.3rem) Fraunces, serif;
            line-height: 1.08;
            margin: 12px 0 10px
        }

        .hero p {
            color: rgba(22, 48, 46, .65);
            max-width: 650px;
            line-height: 1.6;
            margin: 0
        }

        .searchbox {
            margin-top: 28px;
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 8px;
            box-shadow: 0 18px 45px -30px rgba(22, 48, 46, .35)
        }

        .searchgrid {
            display: grid;
            grid-template-columns: 1.1fr 1fr auto;
            gap: 8px
        }

        .field {
            padding: 12px 16px;
            border-radius: 15px;
            background: #fffaf1;
            border: 1px solid transparent
        }

        .field:focus-within {
            border-color: rgba(232, 163, 61, .55)
        }

        label {
            display: block;
            font: 600 .68rem 'Space Grotesk';
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(22, 48, 46, .55);
            margin-bottom: 5px
        }

        .field select,
        .field input {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            font: 600 .95rem Inter;
            color: var(--ink)
        }

        .btn {
            border: 0;
            border-radius: 15px;
            padding: 0 25px;
            background: var(--gold);
            font: 700 .93rem Inter;
            color: var(--ink);
            cursor: pointer
        }

        .btn:hover {
            background: var(--gold2)
        }

        .content {
            padding: 34px 0 80px
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: end;
            margin-bottom: 20px
        }

        .count {
            font: 700 1.25rem Fraunces, serif
        }

        .muted {
            font-size: .86rem;
            color: rgba(22, 48, 46, .58)
        }

        .chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 8px
        }

        .chip {
            padding: 6px 10px;
            border-radius: 99px;
            background: #fff4dc;
            border: 1px solid rgba(232, 163, 61, .28);
            font-size: .78rem
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 20px;
            transition: .2s;
            display: flex;
            flex-direction: column
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 35px -25px rgba(22, 48, 46, .45);
            border-color: rgba(47, 110, 104, .25)
        }

        .top {
            display: flex;
            gap: 13px;
            align-items: center
        }

        .avatar {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: var(--teal);
            color: white;
            display: grid;
            place-items: center;
            font: 700 1.2rem Fraunces, serif
        }

        .name {
            font: 700 1.15rem Fraunces, serif;
            margin: 0
        }

        .location {
            font-size: .78rem;
            color: rgba(22, 48, 46, .6);
            margin-top: 3px
        }

        .status {
            margin-left: auto;
            padding: 5px 9px;
            border-radius: 99px;
            background: #e9f5ee;
            color: #276447;
            font-size: .68rem;
            font-weight: 700
        }

        .meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            margin: 18px 0
        }

        .meta div {
            background: #fbf6eb;
            border-radius: 12px;
            padding: 10px
        }

        .meta small {
            display: block;
            color: rgba(22, 48, 46, .52);
            font-size: .68rem
        }

        .meta strong {
            font-size: .85rem
        }

        .services {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            min-height: 49px
        }

        .service {
            padding: 6px 9px;
            border-radius: 99px;
            background: #f1f5f1;
            font-size: .73rem
        }

        .service.more {
            background: #fff1dc
        }

        .cardfoot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 1px solid var(--line)
        }

        .salary {
            font-weight: 700
        }

        .salary span {
            font-size: .68rem;
            font-weight: 500;
            color: rgba(22, 48, 46, .55)
        }

        .view {
            color: var(--maroon);
            font-weight: 700;
            font-size: .82rem
        }

        .empty {
            text-align: center;
            padding: 70px 20px;
            background: var(--card);
            border: 1px dashed var(--line);
            border-radius: 22px
        }

        .empty h2 {
            font: 700 1.7rem Fraunces, serif;
            margin: 0 0 8px
        }

        .empty p {
            color: rgba(22, 48, 46, .6)
        }

        .reset {
            display: inline-block;
            margin-top: 8px;
            padding: 10px 18px;
            border-radius: 99px;
            background: var(--ink);
            color: white;
            font-weight: 600
        }

        .pagination {
            margin-top: 28px
        }

        .pagination nav {
            display: block
        }

        .pagination .flex {
            justify-content: center;
            gap: 5px
        }

        .pagination a,
        .pagination span {
            border-radius: 9px !important
        }

        .map-results-shell {
            display: grid;
            grid-template-columns: minmax(0, 1.08fr) minmax(390px, .92fr);
            height: 680px;
            min-height: 0;
            border: 1px solid var(--line);
            border-radius: 24px;
            overflow: hidden;
            background: var(--card);
            box-shadow: 0 18px 50px -35px rgba(22, 48, 46, .45);
            isolation: isolate;
        }

        .map-pane {
            position: relative;
            min-width: 0;
            min-height: 0;
            overflow: hidden;
            background: #e8eee9;
        }

        #helperMap {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            min-height: 0;
            background: #e8eee9;
            z-index: 1;
        }

        .map-label {
            position: absolute;
            z-index: 500;
            top: 16px;
            left: 16px;
            background: rgba(255, 253, 248, .96);
            backdrop-filter: blur(8px);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 9px 13px;
            font-size: .78rem;
            font-weight: 700;
            box-shadow: 0 8px 25px -18px rgba(22, 48, 46, .6)
        }

        .results-pane {
            position: relative;
            min-width: 0;
            min-height: 0;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 16px;
            background: #fffaf1;
            z-index: 2;
            overscroll-behavior: contain;
            scrollbar-width: thin;
        }

        .results-pane::-webkit-scrollbar {
            width: 8px
        }

        .results-pane::-webkit-scrollbar-thumb {
            background: rgba(22, 48, 46, .18);
            border-radius: 99px
        }

        .results-pane::-webkit-scrollbar-track {
            background: transparent
        }

        .results-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 0 0 12px;
            padding: 2px 2px 10px;
            border-bottom: 1px solid var(--line)
        }

        .results-header strong {
            font: 700 1.05rem Fraunces, serif
        }

        .results-header span {
            font-size: .72rem;
            color: rgba(22, 48, 46, .58)
        }

        .result-card {
            display: block;
            width: 100%;
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 15px;
            margin-bottom: 12px;
            transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
            overflow: hidden
        }

        .result-card:hover,
        .result-card.active {
            border-color: rgba(47, 110, 104, .45);
            box-shadow: 0 12px 28px -22px rgba(22, 48, 46, .6);
            transform: translateY(-1px)
        }

        .result-top {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 0
        }

        .result-avatar {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: var(--teal);
            color: #fff;
            display: grid;
            place-items: center;
            font: 700 1rem Fraunces, serif;
            overflow: hidden;
            flex: 0 0 auto
        }

        .result-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .result-avatar span {
            display: grid;
            place-items: center;
            width: 100%;
            height: 100%
        }

        .result-name {
            font: 700 1rem Fraunces, serif;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .result-location {
            font-size: .73rem;
            color: rgba(22, 48, 46, .58);
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .result-status {
            margin-left: auto;
            flex: 0 0 auto;
            padding: 4px 8px;
            border-radius: 99px;
            background: #e9f5ee;
            color: #276447;
            font-size: .63rem;
            font-weight: 700
        }

        .result-status.unavailable {
            background: #f3eeee;
            color: #8b4a50
        }

        .result-meta {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
            margin: 11px 0 8px
        }

        .result-meta span {
            padding: 5px 8px;
            border-radius: 99px;
            background: #f2f5f1;
            font-size: .68rem
        }

        .result-services {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            min-height: 0
        }

        .result-services span {
            padding: 5px 8px;
            border-radius: 99px;
            background: #fff1dc;
            font-size: .66rem
        }

        .result-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 11px;
            padding-top: 10px;
            border-top: 1px solid var(--line)
        }

        .result-salary {
            font-size: .82rem;
            font-weight: 700
        }

        .result-salary small {
            font-size: .64rem;
            color: rgba(22, 48, 46, .55);
            font-weight: 500
        }

        .result-link {
            font-size: .72rem;
            font-weight: 700;
            color: var(--maroon);
            white-space: nowrap
        }

        .results-empty {
            min-height: 440px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 38px 24px;
            background: var(--card);
            border: 1px dashed rgba(22, 48, 46, .18);
            border-radius: 18px
        }

        .results-empty-icon {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #eef4f1;
            color: var(--teal);
            font-size: 27px;
            margin-bottom: 16px
        }

        .results-empty h3 {
            margin: 0 0 8px;
            font: 700 1.25rem Fraunces, serif
        }

        .results-empty p {
            max-width: 330px;
            margin: 0;
            color: rgba(22, 48, 46, .6);
            font-size: .84rem;
            line-height: 1.6
        }

        .results-empty .reset {
            margin-top: 18px
        }

        .custom-marker {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fffdf8;
            border: 3px solid var(--maroon);
            box-shadow: 0 5px 15px rgba(22, 48, 46, .28);
            overflow: hidden;
            display: grid;
            place-items: center;
            color: var(--ink);
            font: 700 12px Fraunces, serif;
            position: relative
        }

        .custom-marker img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .custom-marker span {
            display: grid;
            place-items: center;
            width: 100%;
            height: 100%
        }

        .custom-marker:after {
            content: "";
            position: absolute;
            bottom: -7px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 10px;
            height: 10px;
            background: #fffdf8;
            border-right: 3px solid var(--maroon);
            border-bottom: 3px solid var(--maroon);
            z-index: -1
        }

        .leaflet-popup-content-wrapper {
            border-radius: 16px
        }

        .leaflet-popup-content {
            margin: 13px;
            min-width: 190px
        }

        .map-popup-name {
            font: 700 1rem Fraunces, serif
        }

        .map-popup-meta {
            font-size: .72rem;
            color: rgba(22, 48, 46, .65);
            margin: 4px 0 8px
        }

        .map-popup-link {
            display: inline-block;
            color: var(--maroon);
            font-weight: 700;
            font-size: .75rem
        }

        @media(max-width:900px) {
            .map-results-shell {
                grid-template-columns: 1fr;
                height: auto;
                overflow: visible
            }

            .map-pane {
                height: 430px;
                border-radius: 24px 24px 0 0
            }

            .results-pane {
                max-height: none;
                overflow: visible;
                padding: 14px
            }

            .custom-marker {
                width: 40px;
                height: 40px
            }
        }

        @media(max-width:580px) {
            .map-pane {
                height: 360px
            }

            .map-label {
                top: 10px;
                left: 10px
            }

            .results-pane {
                padding: 11px
            }

            .result-card {
                padding: 13px
            }

            .results-empty {
                min-height: 330px;
                padding: 30px 18px
            }
        }

        @media(max-width:850px) {
            .navlinks {
                display: none
            }

            .searchgrid {
                grid-template-columns: 1fr
            }

            .btn {
                height: 50px
            }

            .grid {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:580px) {
            .wrap {
                padding: 0 16px
            }

            .hero {
                padding-top: 35px
            }

            .grid {
                grid-template-columns: 1fr
            }

            .toolbar {
                align-items: start;
                gap: 12px;
                flex-direction: column
            }

            .navbtn {
                display: none
            }
        }

        .user-profile {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            text-decoration: none;
            color: inherit;
            padding: 5px 10px;
            border-radius: 25px;
            transition: all 0.2s ease;
        }

        .user-profile:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar-placeholder {
            background: #198754;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
        }

        .user-name {
            font-size: 15px;
            font-weight: 600;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .user-name {
                display: none;
            }

            .user-profile {
                padding: 3px;
            }

            .user-avatar {
                width: 36px;
                height: 36px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="wrap">
            <nav class="nav-links"><a href="{{ route('home') }}" class="brand">Sahayika</a>
                <a href="{{ route('home') }}">होम</a>
                <a href="{{ route('helpers.index') }}">सहायिका खोजें</a>
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
                <a class="navbtn" href="{{ route('login') }}">लॉगिन</a>
                @endauth
            </nav>
        </div>
    </header>
    <section class="hero">
        <div class="wrap"><span class="eyebrow"><i class="dot"></i> Indore · Madhya Pradesh</span>
            <h1>आपके घर के लिए सही<br>सहायिका खोजें।</h1>
            <p>काम, इलाके और आपकी जरूरत के हिसाब से profiles देखें। अनुभव, उपलब्धता और अनुमानित वेतन एक ही जगह पर compare करें।</p>
            <form class="searchbox" method="GET" action="{{ route('helpers.index') }}">
                <div class="searchgrid">
                    <div class="field"><label>किस काम के लिए</label><select name="service">
                            <option value="">सभी सेवाएं</option>@foreach($services as $item)<option value="{{ $item->slug }}" @selected(request('service')===$item->slug)>{{ $item->name_hi ?: $item->name }}</option>@endforeach
                        </select></div>
                    <div class="field"><label>अपना इलाका</label><input name="locality" value="{{ request('locality') }}" list="indore-localities" placeholder="जैसे Vijay Nagar या Nipania"><datalist id="indore-localities">@foreach($localities as $item)<option value="{{ $item->name }}">@endforeach</datalist></div><button class="btn" type="submit">सहायिका खोजें →</button>
                </div>
            </form>
        </div>
    </section>
    <main class="content">
        <div class="wrap">
            <div class="toolbar">
                <div>
                    <div class="count">{{ $helpers->total() }} profiles मिले</div>
                    <div class="muted">Map पर profile location देखें और marker पर क्लिक करके profile खोलें</div>
                </div>
            </div>
            @if(request()->filled('service') || request()->filled('locality'))
            <div class="chips">
                @if($service)<span class="chip">काम: {{ $service->name_hi ?: $service->name }}</span>@endif
                @if($locality)<span class="chip">इलाका: {{ $locality->name }}</span>
                @elseif(request('locality'))<span class="chip">इलाका: {{ request('locality') }}</span>@endif
            </div>
            <br>
            @endif
            <div class="map-results-shell">
                <div class="map-pane">
                    <div id="helperMap"></div>
                    <div class="map-label"><i class="bi bi-geo-alt-fill me-1"></i> Indore · {{ $helpers->total() }} profiles</div>
                </div>
                <div class="results-pane" id="helperResults">
                    <div class="results-header">
                        <strong>{{ $helpers->total() }} सहायिका{{ $helpers->total() === 1 ? '' : 'एँ' }}</strong>
                        <span>{{ $helpers->total() ? 'Profiles उपलब्ध' : 'अभी कोई profile नहीं' }}</span>
                    </div>
                    @if($helpers->count())
                    @foreach($helpers as $helper)
                    @php
                    $initials = collect(preg_split('/\s+/', trim($helper->user->name)))
                    ->map(fn($part) => mb_substr($part,0,1))
                    ->take(2)->implode('');
                    $photo = $helper->profile_photo ? asset('storage/'.$helper->profile_photo) : null;
                    $lat = $helper->latitude;
                    $lng = $helper->longitude;
                    @endphp
                    <a class="result-card helper-result-card"
                        id="helper-card-{{ $helper->id }}"
                        href="{{ route('helpers.show',$helper) }}"
                        data-helper-id="{{ $helper->id }}"
                        data-lat="{{ $lat }}"
                        data-lng="{{ $lng }}"
                        data-name="{{ $helper->user->name }}"
                        data-location="{{ $helper->locality?->name }}, {{ $helper->locality?->city?->name }}"
                        data-experience="{{ $helper->experience_years }}"
                        data-work="{{ $helper->work_type === 'full_time' ? 'Full-time' : 'Part-time' }}"
                        data-salary="{{ number_format($helper->expected_salary) }}"
                        data-profile-url="{{ route('helpers.show',$helper) }}"
                        data-photo="{{ $photo ?? '' }}"
                        data-initials="{{ $initials }}">
                        <div class="result-top">
                            <div class="result-avatar">
                                @if($photo)<img src="{{ $photo }}" alt="{{ $helper->user->name }}" onerror="this.style.display='none'">@endif
                                <span>{{ $initials }}</span>
                            </div>
                            <div>
                                <h2 class="result-name">{{ $helper->user->name }}</h2>
                                <div class="result-location"><i class="bi bi-geo-alt me-1"></i>{{ $helper->locality?->name }}, {{ $helper->locality?->city?->name }}</div>
                            </div>
                            @if($helper->immediate_availability)<span class="result-status">Available</span>@endif
                        </div>
                        <div class="result-meta">
                            <span><i class="bi bi-award me-1"></i>{{ $helper->experience_years }} साल अनुभव</span>
                            <span><i class="bi bi-clock me-1"></i>{{ $helper->work_type === 'full_time' ? 'Full-time' : 'Part-time' }}</span>
                        </div>
                        <div class="result-services">
                            @foreach($helper->services->take(3) as $item)
                            <span>{{ $item->name_hi ?: $item->name }}</span>
                            @endforeach
                            @if($helper->services->count()>3)<span>+{{ $helper->services->count()-3 }} और</span>@endif
                        </div>
                        <div class="result-foot">
                            <div class="result-salary">₹{{ number_format($helper->expected_salary) }} <small>/ माह</small></div>
                            <span class="result-link">Profile देखें <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                    @endforeach
                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                        <div class="text-muted small">
                            Showing {{ $helpers->firstItem() }} to {{ $helpers->lastItem() }} of {{ $helpers->total() }}
                        </div>
                        <div>{{ $helpers->links() }}</div>
                    </div>
                    @else
                    <div class="results-empty">
                        <div class="results-empty-icon"><i class="bi bi-person-search"></i></div>
                        <h3>इस search में अभी कोई सहायिका नहीं मिली</h3>
                        <p>इस इलाके या चुनी गई service के लिए फिलहाल कोई profile उपलब्ध नहीं है। दूसरा area या service चुनकर फिर से देखें।</p>
                        <a class="reset" href="{{ route('helpers.index') }}"><i class="bi bi-arrow-counterclockwise me-1"></i> सभी profiles देखें</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mapEl = document.getElementById('helperMap');
            if (!mapEl) return;
            // Indore center. Helper-specific coordinates are used when available.
            const map = L.map('helperMap', {
                scrollWheelZoom: true,
                zoomControl: true,
                preferCanvas: true
            }).setView([22.7196, 75.8577], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            // Leaflet needs a size refresh when the grid/container has just been painted.
            requestAnimationFrame(() => map.invalidateSize(false));
            window.addEventListener('resize', () => map.invalidateSize(false));
            const cards = [...document.querySelectorAll('.helper-result-card')];
            const markers = {};
            const bounds = [];
            const escapeHtml = (value) => {
                const div = document.createElement('div');
                div.textContent = value ?? '';
                return div.innerHTML;
            };
            cards.forEach(card => {
                const lat = parseFloat(card.dataset.lat);
                const lng = parseFloat(card.dataset.lng);
                // If a profile does not yet have coordinates, it remains in the list
                // but is not placed as a false location on the map.
                if (!Number.isFinite(lat) || !Number.isFinite(lng)) return;
                const photo = card.dataset.photo;
                const initials = card.dataset.initials || '?';
                const avatar = photo ?
                    `<img src="${escapeHtml(photo)}" alt="" onerror="this.style.display='none'">` :
                    `<span>${escapeHtml(initials)}</span>`;
                const icon = L.divIcon({
                    className: '',
                    html: `<div class="custom-marker">${avatar}</div>`,
                    iconSize: [44, 52],
                    iconAnchor: [22, 48],
                    popupAnchor: [0, -45]
                });
                const marker = L.marker([lat, lng], {
                    icon
                }).addTo(map);
                marker.bindPopup(`
            <div>
                <div class="map-popup-name">${escapeHtml(card.dataset.name)}</div>
                <div class="map-popup-meta">
                    ${escapeHtml(card.dataset.location)} · ${escapeHtml(card.dataset.experience)} साल · ${escapeHtml(card.dataset.work)}
                </div>
                <div style="font-weight:700;margin-bottom:7px;">₹${escapeHtml(card.dataset.salary)} / माह</div>
                <a class="map-popup-link" href="${escapeHtml(card.dataset.profileUrl)}">पूरी Profile देखें →</a>
            </div>
        `);
                marker.on('click', function() {
                    cards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                    card.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                });
                markers[card.dataset.helperId] = marker;
                bounds.push([lat, lng]);
                card.addEventListener('mouseenter', () => marker.setZIndexOffset(1000));
                card.addEventListener('mouseleave', () => marker.setZIndexOffset(0));
                card.addEventListener('click', () => {
                    if (markers[card.dataset.helperId]) {
                        map.setView([lat, lng], Math.max(map.getZoom(), 14), {
                            animate: true
                        });
                        markers[card.dataset.helperId].openPopup();
                    }
                });
            });
            if (bounds.length > 1) {
                map.fitBounds(bounds, {
                    padding: [45, 45],
                    maxZoom: 14
                });
            } else if (bounds.length === 1) {
                map.setView(bounds[0], 14);
            }
        });
    </script>
</body>

</html>