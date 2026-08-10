<!DOCTYPE html>
<html lang="hi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $helperProfile->user->name }} — Sahayika Profile</title>
    <meta name="description" content="Indore में घरेलू काम, खाना, Baby Care और Elder Care के लिए सहायिका खोजें।">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #16302E;
            --paper: #FBF5EA;
            --gold: #E8A33D;
            --gold-dark: #CE8A28;
            --maroon: #A63446;
            --teal: #2F6E68;
            --card: #FFFDF8;
            --line: rgba(22, 48, 46, .12);
            --muted: rgba(22, 48, 46, .58);
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: Inter, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .wrap {
            max-width: 1000px;
            margin: auto;
            padding: 0 22px
        }

        a {
            text-decoration: none;
            color: inherit
        }

        button {
            font-family: inherit
        }

        header {
            border-bottom: 1px solid var(--line);
            background: rgba(251, 245, 234, .95);
            backdrop-filter: blur(6px);
            position: sticky;
            top: 0;
            z-index: 10
        }

        .nav {
            height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .brand {
            font: 700 1.4rem Fraunces, serif;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .brand i {
            color: var(--gold-dark)
        }

        .back {
            font-weight: 600;
            color: var(--maroon);
            font-size: .88rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: gap .15s ease;
        }

        .back:hover {
            gap: 9px
        }

        .page {
            padding: 38px 0 80px
        }

        .profile {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 20px 60px -40px rgba(22, 48, 46, .4)
        }

        .cover {
            height: 150px;
            background: linear-gradient(125deg, var(--teal), var(--ink));
            position: relative;
        }

        .cover::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 85% 20%, rgba(232, 163, 61, .25), transparent 55%);
        }

        .avatar-wrap {
            position: absolute;
            left: 35px;
            bottom: -48px;
            width: 108px;
            height: 108px;
        }

        .avatar {
            width: 100%;
            height: 100%;
            border-radius: 26px;
            border: 6px solid var(--card);
            background: var(--gold);
            display: grid;
            place-items: center;
            font: 700 2rem Fraunces, serif;
            color: var(--ink);
            overflow: hidden;
            box-shadow: 0 10px 24px -10px rgba(22, 48, 46, .45);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .avail-dot {
            position: absolute;
            right: -3px;
            bottom: -3px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 4px solid var(--card);
            background: #2f9e5c;
        }

        .avail-dot.offline {
            background: #b8b0a0
        }

        .body {
            padding: 68px 35px 35px
        }

        .head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-start;
        }

        .name {
            font: 700 clamp(1.7rem, 4vw, 2.6rem) Fraunces, serif;
            margin: 0 0 6px;
            line-height: 1.1
        }

        .place {
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .95rem
        }

        .place i {
            color: var(--maroon)
        }

        .head-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 13px;
            border-radius: 99px;
            background: #e9f5ee;
            color: #276447;
            font-size: .74rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge.offline {
            background: #f2eee4;
            color: #7a7263
        }

        .badge .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #2f9e5c
        }

        .badge.offline .dot {
            background: #a39c8c
        }

        .icon-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid var(--line);
            background: var(--card);
            display: grid;
            place-items: center;
            color: var(--maroon);
            font-size: 1.05rem;
            transition: background .15s ease, transform .15s ease, border-color .15s ease;
            flex-shrink: 0;
            cursor: pointer;
        }

        .icon-btn:hover {
            background: #fbecef;
            border-color: var(--maroon);
            transform: translateY(-1px)
        }

        .icon-btn.is-saved {
            background: var(--maroon);
            color: #fff;
            border-color: var(--maroon)
        }

        .icon-btn:focus-visible {
            outline: 2px solid var(--maroon);
            outline-offset: 2px
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 26px
        }

        .stat {
            padding: 14px 15px;
            background: var(--card);
            border-radius: 14px;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stat i {
            font-size: 1.15rem;
            color: var(--gold-dark)
        }

        .stat small {
            display: block;
            color: var(--muted);
            font-size: .68rem;
            margin-bottom: 2px
        }

        .stat strong {
            font-size: .92rem
        }

        .grid {
            display: grid;
            grid-template-columns: 1.3fr .7fr;
            gap: 20px;
            margin-top: 22px
        }

        .box {
            border: 1px solid var(--line);
            border-radius: 19px;
            padding: 22px;
            background: #fffaf1;
        }

        .box h2 {
            font: 700 1.15rem Fraunces, serif;
            margin: 0 0 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .box h2 i {
            color: var(--gold-dark);
            font-size: 1rem
        }

        .bio {
            color: rgba(22, 48, 46, .72);
            line-height: 1.7;
            margin: 0
        }

        .services {
            display: flex;
            flex-wrap: wrap;
            gap: 8px
        }

        .service {
            padding: 8px 13px;
            border-radius: 99px;
            background: #eef4f0;
            font-size: .8rem;
            border: 1px solid rgba(47, 110, 104, .15);
        }

        .days {
            display: grid;
            gap: 2px
        }

        .day {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .84rem;
            padding: 9px 0;
            border-bottom: 1px solid var(--line);
        }

        .day:last-child {
            border-bottom: none
        }

        .day span {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted)
        }

        .day span i {
            font-size: .8rem;
            color: var(--teal)
        }

        .salary {
            font: 700 1.7rem Fraunces, serif;
            display: flex;
            align-items: baseline;
            gap: 6px
        }

        .salary small {
            font: 400 .78rem Inter;
            color: var(--muted)
        }

        .salary-note {
            margin-top: 8px;
            color: var(--muted);
            font-size: .75rem;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .lang-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px
        }

        .lang-chip {
            font-size: .78rem;
            padding: 6px 11px;
            border-radius: 99px;
            background: #f3ede0;
            border: 1px solid var(--line);
        }

        /* CTA */
        .cta {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px
        }

        .btn {
            padding: 14px 18px;
            border-radius: 14px;
            background: var(--gold);
            color: var(--ink);
            font-weight: 700;
            font-size: .92rem;
            border: none;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            cursor: pointer;
            transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
        }

        .btn i {
            font-size: 1.05rem
        }

        .btn:hover {
            background: var(--gold-dark);
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -12px rgba(22, 48, 46, .5)
        }

        .btn:focus-visible {
            outline: 2px solid var(--ink);
            outline-offset: 2px
        }

        .btn.secondary {
            background: var(--ink);
            color: #fff
        }

        .btn.secondary:hover {
            background: #0f211f
        }

        .btn.outline {
            background: transparent;
            color: var(--ink);
            border: 1.5px solid var(--line)
        }

        .btn.outline:hover {
            background: #f3ede0;
            transform: none;
            box-shadow: none
        }

        .btn.static {
            cursor: default;
            background: #eef4f0;
            color: var(--muted)
        }

        .btn.static:hover {
            transform: none;
            box-shadow: none;
            background: #eef4f0
        }

        .btn.blocked {
            background: #f1eee8;
            color: #a39c8c
        }

        .btn.blocked:hover {
            transform: none;
            box-shadow: none;
            background: #f1eee8
        }

        .cta form {
            width: 100%
        }

        /* Modal polish */
        .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden
        }

        .modal-header {
            background: #fffaf1;
            border-bottom: 1px solid var(--line)
        }

        .modal-title {
            font: 700 1.2rem Fraunces, serif
        }

        .modal-footer {
            border-top: 1px solid var(--line)
        }

        .modal-footer .btn {
            width: auto
        }

        .form-label {
            font-weight: 600;
            font-size: .85rem;
            color: var(--ink)
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border-color: var(--line)
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(47, 110, 104, .15)
        }

        @media(max-width:750px) {
            .grid {
                grid-template-columns: 1fr
            }

            .head {
                flex-direction: column
            }

            .head-actions {
                align-self: flex-end
            }

            .body {
                padding: 64px 20px 28px
            }

            .cover {
                height: 130px
            }

            .avatar-wrap {
                left: 20px;
                width: 92px;
                height: 92px;
                bottom: -42px
            }

            .stats {
                grid-template-columns: 1fr 1fr
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="wrap">
            <div class="nav">
                <a class="brand" href="{{ route('home') }}"><i class="bi bi-house-heart-fill"></i> Sahayika</a>
                <a class="back" href="{{ route('helpers.index') }}"><i class="bi bi-arrow-left"></i> सहायिका खोजें</a>
            </div>
        </div>
    </header>

    <main class="page">
        <div class="wrap">
            <article class="profile">
                <div class="cover">
                    <div class="avatar-wrap">
                        <div class="avatar">
                            @if($helperProfile->user->photo_url ?? false)
                            <img src="{{ $helperProfile->user->photo_url }}" alt="{{ $helperProfile->user->name }}">
                            @else
                            {{ collect(preg_split('/\s+/', trim($helperProfile->user->name)))->map(fn($part)=>mb_substr($part,0,1))->take(2)->implode('') }}
                            @endif
                        </div>
                        <span class="avail-dot {{ $helperProfile->availability_status === 'available' ? '' : 'offline' }}"></span>
                    </div>
                </div>

                <div class="body">
                    <div class="head">
                        <div>
                            <h1 class="name">{{ $helperProfile->user->name }}</h1>
                            <div class="place">
                                <i class="bi bi-geo-alt-fill"></i>
                                {{ $helperProfile->locality?->name }}, {{ $helperProfile->locality?->city?->name }}, {{ $helperProfile->locality?->city?->state?->name }}
                            </div>
                        </div>
                        <div class="head-actions">
                            <span class="badge {{ $helperProfile->availability_status === 'available' ? '' : 'offline' }}">
                                <span class="dot"></span>
                                {{ $helperProfile->availability_status === 'available' ? 'उपलब्ध' : 'अभी उपलब्ध नहीं' }}
                            </span>
                            @if(auth()->check() && auth()->user()->isCustomer())
                            <form method="POST" action="{{ route('dashboard.helper.favorite',$helperProfile) }}">
                                @csrf
                                <button class="icon-btn {{ ($isFavorited ?? false) ? 'is-saved' : '' }}" type="submit" title="Save / Favorite" aria-label="Save profile">
                                    <i class="bi {{ ($isFavorited ?? false) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <div class="stats">
                        <div class="stat">
                            <i class="bi bi-award"></i>
                            <div><small>अनुभव</small><strong>{{ $helperProfile->experience_years }} साल</strong></div>
                        </div>
                        <div class="stat">
                            <i class="bi bi-briefcase"></i>
                            <div><small>काम</small><strong>{{ $helperProfile->work_type === 'full_time' ? 'Full-time' : 'Part-time' }}</strong></div>
                        </div>
                        <div class="stat">
                            <i class="bi bi-lightning-charge"></i>
                            <div><small>तुरंत उपलब्ध</small><strong>{{ $helperProfile->immediate_availability ? 'हाँ' : 'नहीं' }}</strong></div>
                        </div>
                    </div>

                    <div class="grid">
                        <div>
                            <section class="box">
                                <h2><i class="bi bi-person-lines-fill"></i> मेरे बारे में</h2>
                                <p class="bio">{{ $helperProfile->bio ?: 'घरेलू और परिवार-सहायता के काम के लिए उपलब्ध demo profile.' }}</p>
                            </section>

                            <section class="box" style="margin-top:18px">
                                <h2><i class="bi bi-stars"></i> सेवाएं</h2>
                                <div class="services">
                                    @foreach($helperProfile->services as $service)
                                    <span class="service">{{ $service->name_hi ?: $service->name }}</span>
                                    @endforeach
                                </div>
                            </section>

                            <section class="box" style="margin-top:18px">
                                <h2><i class="bi bi-calendar-week"></i> उपलब्ध समय</h2>
                                <div class="days">
                                    @php $days=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']; @endphp
                                    @foreach($helperProfile->availabilities as $slot)
                                    <div class="day">
                                        <span><i class="bi bi-clock"></i> {{ $days[$slot->day_of_week] }}</span>
                                        <strong>{{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }} – {{ \Carbon\Carbon::parse($slot->end_time)->format('g:i A') }}</strong>
                                    </div>
                                    @endforeach
                                </div>
                            </section>
                        </div>

                        <aside>
                            <div class="box">
                                <h2><i class="bi bi-cash-coin"></i> अपेक्षित वेतन</h2>
                                <div class="salary">
                                    ₹{{ number_format($helperProfile->expected_salary) }}
                                    <small>/ {{ $helperProfile->salary_type === 'monthly' ? 'माह' : $helperProfile->salary_type }}</small>
                                </div>
                                <div class="salary-note"><i class="bi bi-info-circle"></i> Demo profile value</div>
                            </div>

                            <div class="box" style="margin-top:18px">
                                <h2><i class="bi bi-translate"></i> भाषाएं</h2>
                                <div class="lang-list">
                                    @foreach(explode(',', $helperProfile->languages ?: 'Hindi') as $lang)
                                    <span class="lang-chip">{{ trim($lang) }}</span>
                                    @endforeach
                                </div>

                                <h2 style="margin-top:22px"><i class="bi bi-pin-map"></i> इलाका</h2>
                                <p class="bio">{{ $helperProfile->locality?->name }}, Indore</p>
                            </div>

                            <div class="cta">
                                @if(auth()->check() && auth()->user()->isCustomer())
                                <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#bookModal">
                                    <i class="bi bi-calendar-check"></i> बुकिंग अनुरोध
                                </button>

                                @if(!$contactRequest || $contactRequest->status === 'denied')
                                <form method="POST" action="{{ route('dashboard.helper.contact',$helperProfile) }}">
                                    @csrf
                                    <button class="btn secondary" type="submit">
                                        <i class="bi bi-chat-dots"></i> Contact / Request
                                    </button>
                                </form>
                                @elseif($contactRequest->status === 'pending')
                                <span class="btn static"><i class="bi bi-hourglass-split"></i> Request Sent</span>
                                @elseif($contactRequest->status === 'accepted' && !$contactRequest->blocked_at)
                                <a class="btn secondary" href="{{ route('dashboard.contacts.chat',$contactRequest) }}">
                                    <i class="bi bi-chat-dots-fill"></i> Chat / Call
                                </a>
                                @else
                                <span class="btn blocked"><i class="bi bi-slash-circle"></i> Contact Blocked</span>
                                @endif
                                @elseif(auth()->check())
                                <a class="btn" href="{{ route('dashboard.index') }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                                @else
                                <a class="btn" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right"></i> लॉगिन करके संपर्क करें
                                </a>
                                @endif
                            </div>

                            @if(auth()->check() && auth()->user()->isCustomer())
                            <div class="modal fade" id="bookModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <form class="modal-content" method="POST" action="{{ route('dashboard.helper.book',$helperProfile) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="bi bi-calendar-check"></i> Booking request</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Service</label>
                                            <select name="service_id" class="form-select mb-3" required>
                                                @foreach($helperProfile->services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name_hi ?: $service->name }}</option>
                                                @endforeach
                                            </select>
                                            <label class="form-label">Preferred date</label>
                                            <input type="date" name="booking_date" class="form-control mb-3" min="{{ date('Y-m-d') }}">
                                            <label class="form-label">Start time</label>
                                            <input type="time" name="start_time" class="form-control mb-3">
                                            <label class="form-label">Duration (hours)</label>
                                            <input type="number" name="duration_hours" class="form-control mb-3" min="1" max="24">
                                            <label class="form-label">Note for helper</label>
                                            <textarea name="customer_note" class="form-control" rows="3" placeholder="Tell the helper what you need"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn outline" type="button" data-bs-dismiss="modal">Cancel</button>
                                            <button class="btn secondary" type="submit"><i class="bi bi-send-fill"></i> Send request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </aside>
                    </div>
                </div>
            </article>
        </div>
    </main>
</body>

</html>