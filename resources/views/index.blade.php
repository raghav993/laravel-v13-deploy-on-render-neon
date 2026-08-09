@extends('layouts_site') @section('content')
<!-- HERO -->
<section class="hero">
    <div class="wrap hero-grid">
        <div>
            <div class="eyebrow"><span class="dot"></span><span class="label" style="letter-spacing:.08em;">अपने शहर में घर की मदद</span></div>
            <h2 class="headline">{{ $siteSettings['hero_title']->value ?? 'घर के काम में मदद चाहिए? भरोसे की सहायिका ढूंढें।' }}</h2>
            <p class="sub">{{ $siteSettings['hero_text']->value ?? 'झाड़ू-पोंछा, बर्तन, खाना बनाने वाली, कपड़े धोना, बेबी केयर, बच्चों और बुज़ुर्गों की देखभाल — अपने शहर की सहायिका के प्रोफाइल देखें, अनुभव व सेवाएं जानें, और सीधे बात करें।' }}</p>
            <form class="search-card" method="GET" action="{{ route('helpers.index') }}">
                <div class="search-row">
                    <div class="field">
                        <label>किस काम के लिए</label>
                        <select name="service">
                            <option value="">सभी सेवाएं</option>
                            @foreach($searchServices as $searchService)
                            <option value="{{ $searchService->slug }}">{{ $searchService->name_hi ?: $searchService->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>अपना इलाका</label>
                        <input type="text" name="locality" list="home-localities" placeholder="इलाका या पिनकोड डालें">
                        <datalist id="home-localities">
                            @foreach($searchLocalities as $searchLocality)
                            <option value="{{ $searchLocality->name }}">
                                @endforeach
                        </datalist>
                    </div>
                    <button type="submit" class="btn btn-primary">सहायिका/सहायक खोजें</button>
                </div>
            </form>
            <div class="trust-line">
                <div class="avatars">
                    <span style="background-color:#c98b4a;"><img src="{{asset('assets/img/testimonials/1.png')}}" class="rounded-circle" alt=""></span>
                    <span style="background-color:#7a9e9f;"><img src="{{asset('assets/img/testimonials/2.png')}}" class="rounded-circle" alt=""></span>
                    <span style="background-color:#c15b5b;"><img src="{{asset('assets/img/testimonials/3.png')}}" class="rounded-circle" alt=""></span>
                    <span style="background-color:#43645f;"><img src="{{asset('assets/img/testimonials/4.png')}}" class="rounded-circle" alt=""></span>
                    <span style="background-color:#43645f;"><img src="{{asset('assets/img/testimonials/5.png')}}" class="rounded-circle" alt=""></span>
                    <span style="background-color:#43645f;"><img src="{{asset('assets/img/testimonials/6.png')}}" class="rounded-circle" alt=""></span>
                </div>
                <small>हर प्रोफाइल में अनुभव, सेवाएं और इलाका साफ़ दिखेगा — फैसला आपका। <a href="register" style="color:var(--maroon);font-weight:600;">काम के लिए रजिस्टर करें →</a></small>
            </div>
        </div>
        <div class="hero-visual">
            <div class="visual-frame">
                <img src="{{ isset($siteSettings['banner']) ? asset('storage/'.$siteSettings['banner']->value) : asset('/assets/img/3.jpeg') }}" alt="भारतीय घर में परंपरागत चूल्हे पर खाना बनाती घरेलू सहायिका - Sahayika पर खाना बनाने वाली खोजें" loading="lazy">
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
            <span class="stamp"><svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="8" r="3.5" stroke="#A63446" stroke-width="1.7" />
                    <path d="M5 20 C5 16 8 14 12 14 C16 14 19 16 19 20" stroke="#A63446" stroke-width="1.7" stroke-linecap="round" />
                </svg></span>
            <strong>प्रोफाइल</strong><span>हर सहायिका की जानकारी</span>
        </div>
        <div class="trust-item">
            <span class="stamp"><svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M12 7 V12 L15.5 14" stroke="#A63446" stroke-width="1.7" stroke-linecap="round" />
                    <circle cx="12" cy="12" r="8.5" stroke="#A63446" stroke-width="1.7" />
                </svg></span>
            <strong>अनुभव</strong><span>वर्षों का अनुभव देखें</span>
        </div>
        <div class="trust-item">
            <span class="stamp"><svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M4 20 L20 20 M6 20 V10 L12 4 L18 10 V20" stroke="#A63446" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                </svg></span>
            <strong>सेवाएं</strong><span>कौन-सा काम करती हैं</span>
        </div>
        <div class="trust-item">
            <span class="stamp"><svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M12 21 C12 21 5 14.5 5 9.5 C5 5.9 8.1 3 12 3 C15.9 3 19 5.9 19 9.5 C19 14.5 12 21 12 21Z" stroke="#A63446" stroke-width="1.7" />
                    <circle cx="12" cy="9.5" r="2.3" stroke="#A63446" stroke-width="1.7" />
                </svg></span>
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
                        <circle cx="9" cy="8" r="3.2" stroke="#A63446" stroke-width="1.8" />
                        <circle cx="17" cy="9" r="2.4" stroke="#A63446" stroke-width="1.6" />
                        <path d="M4 20 C4 16 6.5 14 9.5 14 C12.5 14 15 16.2 15 20" stroke="#A63446" stroke-width="1.8" stroke-linecap="round" />
                        <path d="M15.5 15 C17.5 15 19 16.6 19 19.5" stroke="#A63446" stroke-width="1.6" stroke-linecap="round" />
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
            <img src="{{asset('/assets/img/4.jpeg')}}" alt="भारतीय माँ अपने बच्चे के साथ घर पर — Sahayika पर बेबी केयर और घरेलू सहायिका खोजें" loading="lazy">
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
                <img src="{{asset('/assets/img/2.jpeg')}}" alt="भारतीय घरेलू सहायक कपड़े प्रेस करते हुए — Sahayika पर काम के लिए रजिस्टर करें" loading="lazy">
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
                    <div class="av" style="background-color:#c98b4a;"><img src="{{asset('assets/img/testimonials/1.png')}}" class="rounded-circle" alt=""></div>
                    <div><strong>Priya Sharma</strong><small>Bengaluru</small></div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p>"आया के तौर पर प्रोफाइल बनाई और अपने इलाके के तीन परिवारों से सीधे जुड़ी। रजिस्टर करना बहुत आसान था।"</p>
                <div class="testi-person">
                    <div class="av" style="background-color:#7a9e9f;"><img src="{{asset('assets/img/testimonials/2.png')}}" class="rounded-circle" alt=""></div>
                    <div><strong>Sunita Devi</strong><small>Pune, सहायिका</small></div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p>"बच्चों की देखभाल के लिए जल्दी सहायिका चाहिए थी — प्रोफाइल देखकर सीधे बात की और उसी दिन काम तय हो गया।"</p>
                <div class="testi-person">
                    <div class="av" style="background-color:#c15b5b;"><img src="{{asset('assets/img/testimonials/3.png')}}" class="rounded-circle" alt=""></div>
                    <div><strong>Arjun Mehta</strong><small>Gurugram</small></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection