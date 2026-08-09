<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahayika — भरोसेमंद घरेलू सहायिका खोजें | Maid, Cook, Baby & Elder Care</title>
    <meta name="description" content="अपने शहर में घर के काम, बर्तन-झाड़ू, खाना बनाने, कपड़े धोने, बेबी केयर और बुज़ुर्गों की देखभाल के लिए सहायिका खोजें। प्रोफाइल देखें, अनुभव जानें और सीधे संपर्क करें — Sahayika पर।">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;0,9..144,900;1,9..144,500&family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #16302E;
            --paper: #FBF5EA;
            --marigold: #E8A33D;
            --marigold-deep: #C97F1F;
            --maroon: #A63446;
            --teal: #2F6E68;
            --card: #FFFDF8;
            --line: rgba(22, 48, 46, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3,
        .display {
            font-family: 'Fraunces', serif;
        }

        .label {
            font-family: 'Space Grotesk', sans-serif;
            text-transform: uppercase;
            letter-spacing: .14em;
            font-weight: 600;
            font-size: .72rem;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .wrap {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
        }

        img {
            max-width: 100%;
            display: block;
        }

        /* ---------- Signature: verification stamp ---------- */
        .stamp {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stamp svg {
            display: block;
        }

        /* ---------- Nav ---------- */
        header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(251, 245, 234, 0.92);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--line);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Fraunces', serif;
            font-weight: 700;
            font-size: 1.35rem;
            color: var(--ink);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-links a {
            font-size: .95rem;
            font-weight: 500;
            color: var(--ink);
            opacity: .8;
            transition: opacity .2s;
        }

        .nav-links a:hover {
            opacity: 1;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: 100px;
            font-weight: 600;
            font-size: .92rem;
            cursor: pointer;
            border: 1.5px solid transparent;
            transition: all .2s ease;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--marigold);
            color: var(--ink);
        }

        .btn-primary:hover {
            background: var(--marigold-deep);
            transform: translateY(-1px);
        }

        .btn-ghost {
            border-color: var(--ink);
            color: var(--ink);
        }

        .btn-ghost:hover {
            background: var(--ink);
            color: var(--paper);
        }

        .btn-dark {
            background: var(--ink);
            color: var(--paper);
        }

        .btn-dark:hover {
            background: var(--teal);
        }

        .menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
        }

        .mobile-panel {
            display: none;
            flex-direction: column;
            gap: 4px;
            padding: 12px 24px 20px;
            border-top: 1px solid var(--line);
        }

        .mobile-panel a {
            padding: 10px 0;
            font-weight: 500;
            border-bottom: 1px solid var(--line);
        }

        .mobile-panel .btn {
            margin-top: 10px;
            width: 100%;
        }

        header.open .mobile-panel {
            display: flex;
        }

        /* ---------- Hero ---------- */
        .hero {
            padding: 64px 0 40px;
            position: relative;
            overflow: hidden;
        }

        .hero-bg-stamps {
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: .06;
            z-index: 0;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            gap: 56px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--card);
            border: 1px solid var(--line);
            padding: 7px 14px;
            border-radius: 100px;
            margin-bottom: 22px;
        }

        .eyebrow .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--marigold-deep);
        }

        h2.headline {
            font-size: clamp(2.4rem, 4.6vw, 3.6rem);
            line-height: 1.06;
            font-weight: 700;
            margin: 0 0 20px;
            letter-spacing: -0.01em;
        }

        h2.headline em {
            font-style: italic;
            font-weight: 500;
            color: var(--marigold-deep);
        }

        .sub {
            font-size: 1.1rem;
            line-height: 1.6;
            color: rgba(22, 48, 46, .72);
            max-width: 480px;
            margin: 0 0 32px;
        }

        .search-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 20px 40px -20px rgba(22, 48, 46, .25);
        }

        .search-row {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 12px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            text-align: left;
            border-right: 1px solid var(--line);
            padding-right: 12px;
        }

        .field:last-of-type {
            border-right: none;
        }

        .field label {
            font-family: 'Space Grotesk', sans-serif;
            font-size: .68rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(22, 48, 46, .55);
        }

        .field select,
        .field input {
            border: none;
            background: transparent;
            font-family: 'Inter', sans-serif;
            font-size: .98rem;
            font-weight: 600;
            color: var(--ink);
            padding: 2px 0;
            outline: none;
        }

        .search-card .btn {
            padding: 14px 26px;
        }

        .trust-line {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 22px;
        }

        .avatars {
            display: flex;
        }

        .avatars span {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2.5px solid var(--paper);
            margin-left: -10px;
            background-size: cover;
            background-position: center;
        }

        .avatars span:first-child {
            margin-left: 0;
        }

        .trust-line small {
            font-size: .85rem;
            color: rgba(22, 48, 46, .65);
        }

        .trust-line strong {
            color: var(--ink);
        }

        .hero-visual {
            position: relative;
        }

        .visual-frame {
            position: relative;
            border-radius: 28px;
            overflow: hidden;
            aspect-ratio: 4/5;
            background: linear-gradient(160deg, var(--teal), var(--ink));
        }

        .visual-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            mix-blend-mode: luminosity;
            opacity: .85;
        }

        .float-badge {
            position: absolute;
            background: var(--card);
            border-radius: 16px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 16px 32px -12px rgba(22, 48, 46, .35);
        }

        .float-badge.b1 {
            top: 22px;
            left: -24px;
        }

        .float-badge.b2 {
            bottom: 26px;
            right: -20px;
        }

        .float-badge strong {
            display: block;
            font-size: 1.15rem;
            font-family: 'Fraunces', serif;
            line-height: 1;
        }

        .float-badge small {
            color: rgba(22, 48, 46, .6);
            font-size: .75rem;
        }

        /* ---------- Stats bar ---------- */
        .stats-bar {
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            margin-top: 56px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .stat {
            padding: 28px 20px;
            text-align: center;
            border-right: 1px solid var(--line);
        }

        .stat:last-child {
            border-right: none;
        }

        .stat strong {
            font-family: 'Fraunces', serif;
            font-size: 2.1rem;
            display: block;
            color: var(--marigold-deep);
        }

        .stat span {
            font-size: .82rem;
            color: rgba(22, 48, 46, .65);
        }

        /* ---------- Section shared ---------- */
        section {
            padding: 88px 0;
        }

        .section-head {
            max-width: 620px;
            margin: 0 auto 48px;
            text-align: center;
        }

        .section-head .label {
            color: var(--maroon);
            display: block;
            margin-bottom: 10px;
        }

        .section-head h2 {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            margin: 0 0 12px;
            font-weight: 700;
        }

        .section-head p {
            color: rgba(22, 48, 46, .68);
            font-size: 1.05rem;
            line-height: 1.6;
            margin: 0;
        }

        /* ---------- Services ---------- */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .svc-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 26px 22px;
            transition: transform .2s, box-shadow .2s;
            position: relative;
        }

        .svc-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 30px -18px rgba(22, 48, 46, .3);
        }

        .svc-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            background: var(--paper);
        }

        .svc-card h3 {
            font-family: 'Fraunces', serif;
            font-size: 1.15rem;
            margin: 0 0 6px;
            font-weight: 600;
        }

        .svc-card p {
            font-size: .88rem;
            color: rgba(22, 48, 46, .62);
            margin: 0 0 14px;
            line-height: 1.5;
        }

        .svc-card .from {
            font-family: 'Space Grotesk', sans-serif;
            font-size: .78rem;
            font-weight: 600;
            color: var(--teal);
        }

        /* ---------- How it works ---------- */
        .steps {
            background: var(--ink);
            color: var(--paper);
            border-radius: 32px;
            padding: 64px 48px;
        }

        .steps .section-head p {
            color: rgba(251, 245, 234, .68);
        }

        .steps .section-head h2 {
            color: var(--paper);
        }

        .steps .section-head .label {
            color: var(--marigold);
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 24px;
        }

        .step {
            position: relative;
            padding-left: 0;
        }

        .step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 22px;
            right: -20px;
            width: 16px;
            height: 16px;
            border-top: 2px solid rgba(232, 163, 61, .45);
            border-right: 2px solid rgba(232, 163, 61, .45);
            transform: rotate(45deg);
        }

        .step .num {
            font-family: 'Fraunces', serif;
            font-size: 3rem;
            color: var(--marigold);
            opacity: .5;
            display: block;
            line-height: 1;
            margin-bottom: 14px;
        }

        .step h3 {
            font-family: 'Fraunces', serif;
            font-size: 1.3rem;
            margin: 0 0 10px;
            font-weight: 600;
        }

        .step p {
            color: rgba(251, 245, 234, .68);
            font-size: .95rem;
            line-height: 1.6;
            margin: 0;
        }

        /* ---------- Why us ---------- */
        .why-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 56px;
            align-items: center;
        }

        .why-visual {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            aspect-ratio: 1/1;
            background: linear-gradient(160deg, #F0DCB6, var(--marigold));
        }

        .why-visual img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .why-stamp-badge {
            position: absolute;
            bottom: -18px;
            left: -18px;
            background: var(--card);
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 16px 30px -12px rgba(22, 48, 46, .4);
        }

        .why-list {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .why-item {
            display: flex;
            gap: 16px;
        }

        .why-item .stamp {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--paper);
            flex-shrink: 0;
        }

        .why-item h3 {
            font-family: 'Fraunces', serif;
            font-size: 1.15rem;
            margin: 0 0 4px;
            font-weight: 600;
        }

        .why-item p {
            margin: 0;
            font-size: .92rem;
            color: rgba(22, 48, 46, .65);
            line-height: 1.55;
        }

        /* ---------- Become a helper CTA ---------- */
        .become-cta {
            background: linear-gradient(135deg, var(--maroon), #7d2536);
            border-radius: 32px;
            padding: 64px 48px;
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 40px;
            align-items: center;
            color: var(--paper);
            position: relative;
            overflow: hidden;
        }

        .become-cta h2 {
            font-size: clamp(1.7rem, 3vw, 2.3rem);
            margin: 0 0 14px;
            color: var(--paper);
        }

        .become-cta p {
            color: rgba(251, 245, 234, .82);
            font-size: 1.02rem;
            line-height: 1.6;
            margin: 0 0 26px;
            max-width: 460px;
        }

        .become-cta .pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 0;
        }

        .become-cta .pill {
            background: rgba(251, 245, 234, .14);
            border: 1px solid rgba(251, 245, 234, .3);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: .85rem;
            font-weight: 500;
        }

        .become-visual {
            background: rgba(251, 245, 234, .1);
            border: 1px solid rgba(251, 245, 234, .25);
            border-radius: 20px;
            padding: 14px;
            text-align: center;
        }

        .become-visual img {
            width: 100%;
            aspect-ratio: 4/5;
            object-fit: cover;
            border-radius: 14px;
        }

        .become-visual span {
            display: block;
            font-size: .85rem;
            color: rgba(251, 245, 234, .8);
            margin-top: 14px;
            line-height: 1.5;
        }

        /* ---------- Trust strip (replaces unverifiable stats) ---------- */
        .trust-strip-bar {
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            margin-top: 56px;
        }

        .trust-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .trust-item {
            padding: 24px 20px;
            text-align: center;
            border-right: 1px solid var(--line);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .trust-item:last-child {
            border-right: none;
        }

        .trust-item strong {
            font-family: 'Fraunces', serif;
            font-size: 1rem;
            font-weight: 600;
            color: var(--ink);
        }

        .trust-item span {
            font-size: .8rem;
            color: rgba(22, 48, 46, .6);
        }

        /* ---------- Testimonials ---------- */
        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .testi-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 26px;
        }

        .testi-stars {
            color: var(--marigold-deep);
            font-size: .9rem;
            letter-spacing: 2px;
            margin-bottom: 14px;
        }

        .testi-card p {
            font-size: .95rem;
            line-height: 1.6;
            color: var(--ink);
            margin: 0 0 20px;
        }

        .testi-person {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .testi-person .av {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--teal);
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
        }

        .testi-person strong {
            display: block;
            font-size: .88rem;
        }

        .testi-person small {
            color: rgba(22, 48, 46, .55);
            font-size: .78rem;
        }

        /* ---------- Footer ---------- */
        footer {
            background: var(--ink);
            color: var(--paper);
            padding: 64px 0 28px;
            margin-top: 40px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 48px;
        }

        .footer-brand .brand {
            color: var(--paper);
        }

        .footer-brand p {
            color: rgba(251, 245, 234, .65);
            font-size: .92rem;
            line-height: 1.6;
            margin: 16px 0 20px;
            max-width: 280px;
        }

        .footer-col .label {
            color: rgba(251, 245, 234, .5);
            margin-bottom: 16px;
            display: block;
        }

        .footer-col a {
            display: block;
            color: rgba(251, 245, 234, .78);
            font-size: .92rem;
            margin-bottom: 12px;
            transition: color .2s;
        }

        .footer-col a:hover {
            color: var(--marigold);
        }

        .footer-bottom {
            border-top: 1px solid rgba(251, 245, 234, .15);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-bottom small {
            color: rgba(251, 245, 234, .5);
            font-size: .82rem;
        }

        .socials {
            display: flex;
            gap: 12px;
        }

        .socials a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(251, 245, 234, .25);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ---------- Responsive ---------- */
        @media (max-width:980px) {

            .hero-grid,
            .why-grid {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                order: -1;
                max-width: 420px;
                margin: 0 auto;
            }

            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 36px;
            }

            .step:not(:last-child)::after {
                display: none;
            }

            .become-cta {
                grid-template-columns: 1fr;
            }

            .testi-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            .stats-grid,
            .trust-strip {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat,
            .trust-item {
                border-bottom: 1px solid var(--line);
            }
        }

        @media (max-width:760px) {

            .nav-links,
            .nav-actions {
                display: none;
            }

            .menu-btn {
                display: block;
            }

            .search-row {
                grid-template-columns: 1fr;
            }

            .field {
                border-right: none;
                border-bottom: 1px solid var(--line);
                padding-bottom: 12px;
                padding-right: 0;
            }

            .float-badge {
                position: static;
                margin-top: 12px;
                box-shadow: none;
                border: 1px solid var(--line);
            }

            .float-badge.b1,
            .float-badge.b2 {
                top: auto;
                left: auto;
                right: auto;
                bottom: auto;
            }

            .services-grid {
                grid-template-columns: 1fr 1fr;
            }

            .why-visual {
                margin-bottom: 8px;
            }

            .become-cta,
            .steps {
                padding: 40px 26px;
                border-radius: 22px;
            }

            .steps-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }

            section {
                padding: 56px 0;
            }

            .trust-line {
                flex-wrap: wrap;
            }
        }

        @media (max-width:520px) {
            .services-grid {
                grid-template-columns: 1fr 1fr;
            }

            .stats-grid,
            .trust-strip {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
</head>

<body>

    <header id="siteHeader">
        <div class="wrap nav">
            <a href="/" class="brand">
              <img src="{{ asset('assets/img/sahayika.png') }}" alt="" width="170px">
            </a>
            <nav class="nav-links">
                <a href="#services">सेवाएं</a>
                <a href="#how">कैसे काम करता है</a>
                <a href="#why">क्यों Sahayika</a>
                <a href="#become">सहायिका बनें</a>
            </nav>
            <div class="nav-actions">
                <a href="login" class="btn btn-ghost">लॉग इन</a>
                <a href="register" class="btn btn-primary">रजिस्टर करें</a>
            </div>
            <button class="menu-btn" onclick="document.getElementById('siteHeader').classList.toggle('open')" aria-label="Toggle menu">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M3 6h18M3 12h18M3 18h18" stroke="#16302E" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>
        <div class="mobile-panel">
            <a href="#services">सेवाएं</a>
            <a href="#how">कैसे काम करता है</a>
            <a href="#why">क्यों Sahayika</a>
            <a href="#become">सहायिका बनें</a>
            <a href="/login" class="btn btn-ghost">लॉग इन</a>
            <a href="/register" class="btn btn-primary">रजिस्टर करें</a>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="wrap hero-grid">
            <div>
                <div class="eyebrow"><span class="dot"></span><span class="label" style="letter-spacing:.08em;">अपने शहर में घर की मदद</span></div>
                <h2 class="headline">घर के काम में मदद चाहिए? <em>भरोसे की सहायिका</em> ढूंढें।</h2>
                <p class="sub">झाड़ू-पोंछा, बर्तन, खाना बनाने वाली, कपड़े धोना, बेबी केयर, बच्चों और बुज़ुर्गों की देखभाल — अपने शहर की सहायिका के प्रोफाइल देखें, अनुभव व सेवाएं जानें, और सीधे बात करें।</p>

                <div class="search-card">
                    <div class="search-row">
                        <div class="field">
                            <label>किस काम के लिए</label>
                            <select>
                                <option>सेवाएं</option>
                                <option>झाड़ू-पोंछा, बर्तन व सफाई</option>
                                <option>खाना बनाने वाली</option>
                                <option>कपड़े धोना / प्रेस</option>
                                <option>Baby Care / आया</option>
                                <option>बच्चों की देखभाल</option>
                                <option>बुज़ुर्गों की देखभाल</option>
                                <option>हर काम में माहिर</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>अपना इलाका</label>
                            <input type="text" placeholder="इलाका या पिनकोड डालें">
                        </div>
                        <button class="btn btn-primary">सहायिका/सहायक खोजें</button>
                    </div>
                </div>

                <div class="trust-line">
                    <div class="avatars">
                        <span style="background-color:#c98b4a;"></span>
                        <span style="background-color:#7a9e9f;"></span>
                        <span style="background-color:#c15b5b;"></span>
                        <span style="background-color:#43645f;"></span>
                    </div>
                    <small>हर प्रोफाइल में अनुभव, सेवाएं और इलाका साफ़ दिखेगा — फैसला आपका। <a href="register" style="color:var(--maroon);font-weight:600;">काम के लिए रजिस्टर करें →</a></small>
                </div>
            </div>

            <div class="hero-visual">
                <div class="visual-frame">
                    <img src="https://images.pexels.com/photos/14596422/pexels-photo-14596422.jpeg?auto=compress&cs=tinysrgb&w=900" alt="भारतीय घर में परंपरागत चूल्हे पर खाना बनाती घरेलू सहायिका - Sahayika पर खाना बनाने वाली खोजें" loading="lazy">
                </div>
                <div class="float-badge b1">
                    <span class="stamp"><svg width="30" height="30" viewBox="0 0 40 40" fill="none">
                            <path d="M20 2 L23.5 5.5 L28.3 4.3 L30 9 L34.7 10.7 L33.5 15.5 L37 19 L33.5 22.5 L34.7 27.3 L30 29 L28.3 33.7 L23.5 32.5 L20 36 L16.5 32.5 L11.7 33.7 L10 29 L5.3 27.3 L6.5 22.5 L3 19 L6.5 15.5 L5.3 10.7 L10 9 L11.7 4.3 L16.5 5.5 Z" fill="#2F6E68" />
                            <path d="M13.5 20 L18 24.5 L27 14.5" stroke="#FBF5EA" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></span>
                    <div><strong>प्रोफाइल में अनुभव</strong><small>सेवाएं व इलाका साफ़ दिखेगा</small></div>
                </div>
                <div class="float-badge b2">
                    <div><strong>अपने इलाके में खोजें</strong><small>पिनकोड या इलाके से खोज</small></div>
                </div>
            </div>
        </div>
    </section>

    <!-- TRUST STRIP: only claims the app actually supports -->
    <div class="trust-strip-bar">
        <div class="wrap trust-strip">
            <div class="trust-item">
                <span class="stamp"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="8" r="3.5" stroke="#A63446" stroke-width="1.7" /><path d="M5 20 C5 16 8 14 12 14 C16 14 19 16 19 20" stroke="#A63446" stroke-width="1.7" stroke-linecap="round" /></svg></span>
                <strong>प्रोफाइल</strong><span>हर सहायिका की जानकारी</span>
            </div>
            <div class="trust-item">
                <span class="stamp"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 7 V12 L15.5 14" stroke="#A63446" stroke-width="1.7" stroke-linecap="round" /><circle cx="12" cy="12" r="8.5" stroke="#A63446" stroke-width="1.7" /></svg></span>
                <strong>अनुभव</strong><span>वर्षों का अनुभव देखें</span>
            </div>
            <div class="trust-item">
                <span class="stamp"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M4 20 L20 20 M6 20 V10 L12 4 L18 10 V20" stroke="#A63446" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" /></svg></span>
                <strong>सेवाएं</strong><span>कौन-सा काम करती हैं</span>
            </div>
            <div class="trust-item">
                <span class="stamp"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 21 C12 21 5 14.5 5 9.5 C5 5.9 8.1 3 12 3 C15.9 3 19 5.9 19 9.5 C19 14.5 12 21 12 21Z" stroke="#A63446" stroke-width="1.7" /><circle cx="12" cy="9.5" r="2.3" stroke="#A63446" stroke-width="1.7" /></svg></span>
                <strong>इलाका</strong><span>अपने पास खोजें</span>
            </div>
        </div>
    </div>

    <!-- SERVICES -->
    <section id="services">
        <div class="wrap">
            <div class="section-head">
                <span class="label">किस तरह की मदद चाहिए?</span>
                <h2>काम किस तरह की मदद चाहिए?</h2>
                <p>अपने घर की ज़रूरत के हिसाब से सही सहायिका चुनें — Part-time हो या Full-time।</p>
            </div>
            <div class="services-grid">
                <div class="svc-card">
                    <div class="svc-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <path d="M4 20 L20 20 M6 20 V10 L12 4 L18 10 V20" stroke="#A63446" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg></div>
                    <h3>घर की सफाई</h3>
                    <p>झाड़ू-पोंछा, बर्तन और सफाई — रोज़ाना, अल्टरनेट-डे या फुल-टाइम।</p>
                    <span class="from">प्रोफाइल में रेट देखें</span>
                </div>
                <div class="svc-card">
                    <div class="svc-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <path d="M6 10 C6 6 9 3 12 3 C15 3 18 6 18 10 M4 10 H20 V13 C20 17 16.5 20 12 20 C7.5 20 4 17 4 13 Z" stroke="#A63446" stroke-width="1.8" stroke-linecap="round" />
                        </svg></div>
                    <h3>खाना बनाने वाली</h3>
                    <p>घर जैसा खाना, टिफिन सर्विस और रसोई के रोज़मर्रा के काम में मदद।</p>
                    <span class="from">प्रोफाइल में रेट देखें</span>
                </div>
                <div class="svc-card">
                    <div class="svc-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <path d="M6 3 V21 M18 3 V21 M6 8 H18 M6 14 H18" stroke="#A63446" stroke-width="1.8" stroke-linecap="round" />
                        </svg></div>
                    <h3>कपड़े धोना / प्रेस</h3>
                    <p>कपड़े धोने, सुखाने और इस्त्री करने में रोज़ की मदद।</p>
                    <span class="from">प्रोफाइल में रेट देखें</span>
                </div>
                <div class="svc-card">
                    <div class="svc-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="7" r="3" stroke="#A63446" stroke-width="1.8" />
                            <path d="M5 21 C5 16.5 8 14 12 14 C16 14 19 16.5 19 21" stroke="#A63446" stroke-width="1.8" stroke-linecap="round" />
                        </svg></div>
                    <h3>Baby Care / आया</h3>
                    <p>नवजात और छोटे बच्चों की देखभाल के लिए अनुभवी आया या नैनी।</p>
                    <span class="from">प्रोफाइल में रेट देखें</span>
                </div>
                <div class="svc-card">
                    <div class="svc-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <path d="M12 21 C12 21 4 15.5 4 9.8 C4 6.6 6.5 4.5 9.2 4.5 C10.9 4.5 12 5.6 12 5.6 C12 5.6 13.1 4.5 14.8 4.5 C17.5 4.5 20 6.6 20 9.8 C20 15.5 12 21 12 21Z" stroke="#A63446" stroke-width="1.8" stroke-linejoin="round" />
                        </svg></div>
                    <h3>बच्चों की मालिश</h3>
                    <p>पारंपरिक तरीके से बच्चों और नवजात की मालिश करने वाली मौसी।</p>
                    <span class="from">प्रोफाइल में रेट देखें</span>
                </div>
                <div class="svc-card">
                    <div class="svc-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <circle cx="9" cy="8" r="3.2" stroke="#A63446" stroke-width="1.8" /><circle cx="17" cy="9" r="2.4" stroke="#A63446" stroke-width="1.6" />
                            <path d="M4 20 C4 16 6.5 14 9.5 14 C12.5 14 15 16.2 15 20" stroke="#A63446" stroke-width="1.8" stroke-linecap="round" /><path d="M15.5 15 C17.5 15 19 16.6 19 19.5" stroke="#A63446" stroke-width="1.6" stroke-linecap="round" />
                        </svg></div>
                    <h3>बच्चों की देखभाल</h3>
                    <p>स्कूल के बाद बच्चों के साथ रहने और उनका ध्यान रखने के लिए नैनी सेवा।</p>
                    <span class="from">प्रोफाइल में रेट देखें</span>
                </div>
                <div class="svc-card">
                    <div class="svc-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <path d="M12 21 C12 21 4 15.5 4 9.8 C4 6.6 6.5 4.5 9.2 4.5 C10.9 4.5 12 5.6 12 5.6 C12 5.6 13.1 4.5 14.8 4.5 C17.5 4.5 20 6.6 20 9.8 C20 15.5 12 21 12 21Z" stroke="#A63446" stroke-width="1.8" stroke-linejoin="round" />
                        </svg></div>
                    <h3>बुज़ुर्गों की देखभाल</h3>
                    <p>साथ, दवाई का ध्यान और रोज़मर्रा के कामों में सहारा।</p>
                    <span class="from">प्रोफाइल में रेट देखें</span>
                </div>
                <div class="svc-card">
                    <div class="svc-icon"><svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="8.5" stroke="#A63446" stroke-width="1.8" />
                            <path d="M12 7 V12 L15.5 14" stroke="#A63446" stroke-width="1.8" stroke-linecap="round" />
                        </svg></div>
                    <h3>Full-time / Part-time</h3>
                    <p>अपनी ज़रूरत के हिसाब से समय, दिन और तरह की मदद खुद तय करें।</p>
                    <span class="from">प्रोफाइल में रेट देखें</span>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how">
        <div class="wrap">
            <div class="steps">
                <div class="section-head">
                    <span class="label">बस 5 आसान स्टेप</span>
                    <h2>सहायिका ढूंढना है बेहद आसान</h2>
                    <p>बिना किसी एजेंट या इंतज़ार के — सीधे प्रोफाइल देखें, बात करें और काम तय करें।</p>
                </div>
                <div class="steps-grid">
                    <div class="step">
                        <span class="num">01</span>
                        <h3>काम बताएं</h3>
                        <p>किस तरह की मदद चाहिए बताएं — सफाई, खाना, बच्चों या बुज़ुर्गों की देखभाल।</p>
                    </div>
                    <div class="step">
                        <span class="num">02</span>
                        <h3>सहायिका देखें</h3>
                        <p>अपने इलाके में उपलब्ध सहायिका के प्रोफाइल ब्राउज़ करें।</p>
                    </div>
                    <div class="step">
                        <span class="num">03</span>
                        <h3>प्रोफाइल समझें</h3>
                        <p>अनुभव, सेवाएं, काम का समय और इलाका ध्यान से देखें।</p>
                    </div>
                    <div class="step">
                        <span class="num">04</span>
                        <h3>संपर्क करें</h3>
                        <p>पसंद आने पर सीधे सहायिका से बात करें।</p>
                    </div>
                    <div class="step">
                        <span class="num">05</span>
                        <h3>काम तय करें</h3>
                        <p>समय, दिन और शर्तें आपस में तय करें।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY US -->
    <section id="why">
        <div class="wrap why-grid">
            <div class="why-visual">
                <img src="https://images.pexels.com/photos/4616521/pexels-photo-4616521.jpeg?auto=compress&cs=tinysrgb&w=800" alt="भारतीय माँ अपने बच्चे के साथ घर पर — Sahayika पर बेबी केयर और घरेलू सहायिका खोजें" loading="lazy">
                <div class="why-stamp-badge">
                    <svg width="56" height="56" viewBox="0 0 40 40" fill="none">
                        <path d="M20 2 L23.5 5.5 L28.3 4.3 L30 9 L34.7 10.7 L33.5 15.5 L37 19 L33.5 22.5 L34.7 27.3 L30 29 L28.3 33.7 L23.5 32.5 L20 36 L16.5 32.5 L11.7 33.7 L10 29 L5.3 27.3 L6.5 22.5 L3 19 L6.5 15.5 L5.3 10.7 L10 9 L11.7 4.3 L16.5 5.5 Z" fill="#E8A33D" stroke="#16302E" stroke-width="1.2" />
                        <path d="M13.5 20 L18 24.5 L27 14.5" stroke="#16302E" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <div>
                <span class="label" style="color:var(--maroon);">क्यों Sahayika</span>
                <h2 style="font-size:clamp(1.8rem,3vw,2.4rem);margin:12px 0 26px;">पूरी जानकारी के साथ, फैसला आपका</h2>
                <div class="why-list">
                    <div class="why-item">
                        <span class="stamp"><svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="3" width="18" height="18" rx="10" fill="#FBF5EA" />
                                <path d="M8 12.5 L11 15.5 L16 9" stroke="#2F6E68" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        <div>
                            <h3>प्रोफाइल में पूरी जानकारी</h3>
                            <p>अनुभव, सेवाएं, काम का इलाका और उपलब्धता — सब कुछ प्रोफाइल में साफ़ दिखेगा।</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <span class="stamp"><svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="3" width="18" height="18" rx="10" fill="#FBF5EA" />
                                <path d="M12 6 V12 L16 14" stroke="#2F6E68" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        <div>
                            <h3>सीधा संपर्क</h3>
                            <p>बिना किसी बिचौलिये के, सीधे सहायिका से बात करें और अपनी शर्तों पर काम तय करें।</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <span class="stamp"><svg width="44" height="44" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="3" width="18" height="18" rx="10" fill="#FBF5EA" />
                                <path d="M7 12 L10 15 L17 8" stroke="#2F6E68" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        <div>
                            <h3>अपने इलाके में खोजें</h3>
                            <p>अपने इलाके या पिनकोड के हिसाब से पास की सहायिका ढूंढें — दूर की चिंता नहीं।</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BECOME A HELPER -->
    <section id="become">
        <div class="wrap">
            <div class="become-cta">
                <div>
                    <span class="label" style="color:var(--marigold);">काम की तलाश है?</span>
                    <h2>अपनी प्रोफाइल बनाएं, परिवारों से सीधे जुड़ें</h2>
                    <p>मुफ़्त में रजिस्टर करें — अपना अनुभव, सेवाएं और इलाका बताएं, और अपने आसपास के परिवारों तक पहुंचें।</p>
                    <div class="pills">
                        <span class="pill">मुफ़्त रजिस्ट्रेशन</span>
                        <span class="pill">अपनी शर्तों पर काम</span>
                        <span class="pill">Full-time या Part-time</span>
                        <span class="pill">अपने इलाके में काम</span>
                    </div>
                    <div style="margin-top:26px;">
                        <a href="register" class="btn btn-primary">काम के लिए रजिस्टर करें</a>
                    </div>
                </div>
                <div class="become-visual">
                    <img src="https://images.pexels.com/photos/8973686/pexels-photo-8973686.jpeg?auto=compress&cs=tinysrgb&w=700" alt="भारतीय घरेलू सहायक कपड़े प्रेस करते हुए — Sahayika पर काम के लिए रजिस्टर करें" loading="lazy">
                    <span>अपनी प्रोफाइल बनाएं — परिवार आपको सीधे इलाके और सेवाओं के हिसाब से खोजेंगे।</span>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section>
        <div class="wrap">
            <div class="section-head">
                <span class="label">परिवार क्या कहते हैं</span>
                <h2>घरों का भरोसा, Sahayika के साथ</h2>
            </div>
            <div class="testi-grid">
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <p>"झाड़ू-पोंछा और बर्तन के लिए भरोसेमंद सहायिका मिल गई — प्रोफाइल में अनुभव और इलाका पहले से साफ़ था।"</p>
                    <div class="testi-person">
                        <div class="av" style="background-color:#c98b4a;"></div>
                        <div><strong>Priya Sharma</strong><small>Bengaluru</small></div>
                    </div>
                </div>
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <p>"आया के तौर पर प्रोफाइल बनाई और अपने इलाके के तीन परिवारों से सीधे जुड़ी। रजिस्टर करना बहुत आसान था।"</p>
                    <div class="testi-person">
                        <div class="av" style="background-color:#7a9e9f;"></div>
                        <div><strong>Sunita Devi</strong><small>Pune, सहायिका</small></div>
                    </div>
                </div>
                <div class="testi-card">
                    <div class="testi-stars">★★★★★</div>
                    <p>"बच्चों की देखभाल के लिए जल्दी सहायिका चाहिए थी — प्रोफाइल देखकर सीधे बात की और उसी दिन काम तय हो गया।"</p>
                    <div class="testi-person">
                        <div class="av" style="background-color:#c15b5b;"></div>
                        <div><strong>Arjun Mehta</strong><small>Gurugram</small></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="wrap">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/" class="brand">
                        <span class="stamp"><svg width="30" height="30" viewBox="0 0 40 40" fill="none">
                                <path d="M20 2 L23.5 5.5 L28.3 4.3 L30 9 L34.7 10.7 L33.5 15.5 L37 19 L33.5 22.5 L34.7 27.3 L30 29 L28.3 33.7 L23.5 32.5 L20 36 L16.5 32.5 L11.7 33.7 L10 29 L5.3 27.3 L6.5 22.5 L3 19 L6.5 15.5 L5.3 10.7 L10 9 L11.7 4.3 L16.5 5.5 Z" fill="#E8A33D" />
                                <path d="M13.5 20 L18 24.5 L27 14.5" stroke="#16302E" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg></span>
                        Sahayika
                    </a>
                    <p>अपने शहर में घर के काम, बच्चों और बुज़ुर्गों की देखभाल के लिए सहायिका खोजें — प्रोफाइल देखें, सीधे जुड़ें।</p>
                    <div class="socials">
                        <a href="#" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <rect x="3" y="3" width="18" height="18" rx="5" stroke="#FBF5EA" stroke-width="1.6" />
                                <circle cx="12" cy="12" r="4" stroke="#FBF5EA" stroke-width="1.6" />
                            </svg></a>
                        <a href="#" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M14 8H16V5H14C12 5 10.5 6.5 10.5 8.5V10H8.5V13H10.5V20H13.5V13H15.5L16 10H13.5V8.7C13.5 8.3 13.7 8 14 8Z" fill="#FBF5EA" />
                            </svg></a>
                        <a href="#" aria-label="Twitter"><svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M4 4 L20 20 M20 4 L4 20" stroke="#FBF5EA" stroke-width="0" />
                                <path d="M21 5 C20.3 5.3 19.5 5.6 18.7 5.7 C19.6 5.1 20.2 4.3 20.5 3.3 C19.7 3.8 18.8 4.1 17.9 4.3 C17.1 3.5 16 3 14.8 3 C12.4 3 10.6 5.2 11.1 7.5 C7.7 7.3 4.7 5.7 2.7 3.1 C1.8 4.6 2.3 6.5 3.7 7.5 C3.1 7.5 2.5 7.3 2 7 C2 8.6 3.1 10 4.7 10.4 C4.2 10.5 3.6 10.6 3.1 10.4 C3.5 11.8 4.8 12.8 6.3 12.8 C5 13.8 3.4 14.3 1.7 14.2 C3.3 15.2 5.1 15.8 7 15.8 C14.8 15.8 18.7 9.4 18.5 5.6 C19.3 5.1 20 4.4 21 5 Z" fill="#FBF5EA" />
                            </svg></a>
                    </div>
                </div>
                <div class="footer-col">
                    <span class="label">सेवाएं</span>
                    <a href="#services">घर की सफाई</a>
                    <a href="#services">खाना बनाने वाली</a>
                    <a href="#services">बच्चों की देखभाल</a>
                    <a href="#services">बुज़ुर्गों की देखभाल</a>
                </div>
                <div class="footer-col">
                    <span class="label">कंपनी</span>
                    <a href="#how">कैसे काम करता है</a>
                    <a href="#become">सहायिका बनें</a>
                    <a href="#">Careers</a>
                    <a href="#">संपर्क करें</a>
                </div>
                <div class="footer-col">
                    <span class="label">अकाउंट</span>
                    <a href="/login">लॉग इन</a>
                    <a href="/register">रजिस्टर करें</a>
                    <a href="#">Help Center</a>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
            <div class="footer-bottom">
                <small>© 2026 Sahayika Technologies Pvt. Ltd. सर्वाधिकार सुरक्षित।</small>
                <small>हर घर के लिए, भरोसेमंद मदद।</small>
            </div>
        </div>
    </footer>

</body>

</html>