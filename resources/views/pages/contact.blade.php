@extends('layouts_site')
@section('content')
<section class="contact-page">
    <div class="contact-wrapper">
        {{-- Header --}}
        <div class="contact-header">
            <div class="eyebrow">
                <i class="bi bi-chat-heart"></i>
                संपर्क करें
            </div>
            <h2>
                हम आपकी मदद
                के लिए यहाँ हैं।
            </h2>
            <p>
                Sahayika से जुड़ी जानकारी, account, profile या service से
                संबंधित कोई सवाल है? हमें बताइए।
            </p>
        </div>
        <div class="contact-grid">
            {{-- Left information --}}
            <div class="contact-info">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div>
                        <span>General Support</span>
                        <h3>
                            {{ config('mail.admin_address', 'support@sahayika.test') }}
                        </h3>
                        <p>
                            Account, profile, service या website से जुड़ी
                            किसी भी सहायता के लिए हमसे संपर्क करें।
                        </p>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div>
                        <span>Business & Partnerships</span>
                        <h3>
                            {{ config('mail.admin_address', 'partners@sahayika.test') }}
                        </h3>
                        <p>
                            Business partnerships और platform enquiries
                            के लिए हमें message भेजें।
                        </p>
                    </div>
                </div>
                <div class="contact-trust">
                    <div class="trust-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div>
                        <strong>
                            आपकी बात हमारे लिए महत्वपूर्ण है।
                        </strong>
                        <p>
                            सही जानकारी देने से हमारी टीम आपकी मदद
                            जल्दी कर पाएगी।
                        </p>
                    </div>
                </div>
            </div>
            {{-- Contact Form --}}
            <div class="contact-form-card">
                @if(session('success'))
                <div class="alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>
                        <strong>संदेश भेज दिया गया</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
                @endif
                <div class="form-heading">
                    <span>
                        <i class="bi bi-envelope-paper"></i>
                    </span>
                    <div>
                        <h2>हमें संदेश भेजें</h2>
                        <p>
                            नीचे दी गई जानकारी भरें और हमसे संपर्क करें।
                        </p>
                    </div>
                </div>
                <form
                    method="POST"
                    action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">
                                आपका नाम
                            </label>
                            <div class="input-wrap">
                                <i class="bi bi-person"></i>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', auth()->user()->name ?? '') }}"
                                    placeholder="अपना नाम लिखें"
                                    required>
                            </div>
                            @error('name')
                            <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                ईमेल
                            </label>
                            <div class="input-wrap">
                                <i class="bi bi-envelope"></i>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', auth()->user()->email ?? '') }}"
                                    placeholder="you@example.com"
                                    required>
                            </div>
                            @error('email')
                            <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">
                                मोबाइल नंबर
                                <span>(वैकल्पिक)</span>
                            </label>
                            <div class="input-wrap">
                                <i class="bi bi-phone"></i>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="10 digit mobile number"
                                    maxlength="20">
                            </div>
                            @error('phone')
                            <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                किस बारे में मदद चाहिए?
                            </label>
                            <div class="input-wrap">
                                <i class="bi bi-chat-left-text"></i>
                                <select
                                    id="subject"
                                    name="subject"
                                    required>
                                    <option value="">
                                        विषय चुनें
                                    </option>
                                    <option
                                        value="Account Help"
                                        @selected(old('subject')==='Account Help' )>
                                        Account / Login
                                    </option>
                                    <option
                                        value="Helper Profile"
                                        @selected(old('subject')==='Helper Profile' )>
                                        Helper Profile
                                    </option>
                                    <option
                                        value="Service Enquiry"
                                        @selected(old('subject')==='Service Enquiry' )>
                                        Service / सहायिका
                                    </option>
                                    <option
                                        value="Technical Issue"
                                        @selected(old('subject')==='Technical Issue' )>
                                        Website / Technical Issue
                                    </option>
                                    <option
                                        value="Partnership"
                                        @selected(old('subject')==='Partnership' )>
                                        Business / Partnership
                                    </option>
                                    <option
                                        value="Other"
                                        @selected(old('subject')==='Other' )>
                                        अन्य
                                    </option>
                                </select>
                            </div>
                            @error('subject')
                            <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">
                            आपका संदेश
                        </label>
                        <div class="textarea-wrap">
                            <i class="bi bi-pencil"></i>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                maxlength="5000"
                                placeholder="हमें बताएं कि आपको किस चीज़ में मदद चाहिए..."
                                required>{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                        <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <button
                        type="submit"
                        class="contact-submit">
                        <span>संदेश भेजें</span>
                        <i class="bi bi-arrow-right"></i>
                    </button>
                    <p class="form-note">
                        <i class="bi bi-shield-check"></i>
                        आपकी दी गई जानकारी केवल आपकी enquiry को handle करने
                        के लिए उपयोग की जाएगी।
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<style>
    .contact-page {
        padding: 80px 20px;
        background:
            radial-gradient(circle at top right,
                rgba(22, 48, 46, .08),
                transparent 35%),
            #fffaf4;
    }

    .contact-wrapper {
        max-width: 1180px;
        margin: auto;
    }

    .contact-header {
        max-width: 700px;
        margin-bottom: 48px;
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #b66b3c;
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 16px;
    }

    .contact-header h2 {
        margin: 0;
        color: #16302e;
        font-size: clamp(32px, 5vw, 56px);
        line-height: 1.25;
        letter-spacing: -0.5px;
    }

    .contact-header>p {
        margin-top: 22px;
        max-width: 650px;
        color: #66716f;
        font-size: 18px;
        line-height: 1.7;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: .85fr 1.15fr;
        gap: 30px;
        align-items: start;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .info-card {
        display: flex;
        gap: 18px;
        padding: 24px;
        background: #ffffff;
        border: 1px solid #eee6dc;
        border-radius: 18px;
    }

    .info-icon {
        width: 48px;
        height: 48px;
        flex: 0 0 48px;
        display: grid;
        place-items: center;
        border-radius: 14px;
        background: #edf3ef;
        color: #16302e;
        font-size: 21px;
    }

    .info-card span {
        color: #8a918f;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .info-card h3 {
        margin: 5px 0 8px;
        color: #16302e;
        font-size: 17px;
        word-break: break-word;
    }

    .info-card p {
        margin: 0;
        color: #727a78;
        line-height: 1.6;
        font-size: 14px;
    }

    .contact-trust {
        display: flex;
        gap: 14px;
        margin-top: 5px;
        padding: 22px;
        border-radius: 18px;
        background: #16302e;
        color: #fff8ee;
    }

    .trust-icon {
        font-size: 22px;
    }

    .contact-trust strong {
        font-size: 15px;
    }

    .contact-trust p {
        margin: 5px 0 0;
        color: rgba(255, 248, 238, .72);
        font-size: 14px;
        line-height: 1.5;
    }

    .contact-form-card {
        padding: 34px;
        background: #ffffff;
        border: 1px solid #ebe4da;
        border-radius: 22px;
        box-shadow: 0 18px 50px rgba(22, 48, 46, .07);
    }

    .form-heading {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 30px;
    }

    .form-heading>span {
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        background: #f5eadf;
        color: #b66b3c;
        border-radius: 14px;
        font-size: 21px;
    }

    .form-heading h2 {
        margin: 0;
        color: #16302e;
        font-size: 24px;
    }

    .form-heading p {
        margin: 4px 0 0;
        color: #7b8381;
        font-size: 14px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #293633;
        font-size: 14px;
        font-weight: 700;
    }

    .form-group label span {
        color: #929895;
        font-weight: 400;
    }

    .input-wrap,
    .textarea-wrap {
        position: relative;
    }

    .input-wrap>i,
    .textarea-wrap>i {
        position: absolute;
        left: 15px;
        top: 16px;
        color: #8c9692;
        pointer-events: none;
    }

    .input-wrap input,
    .input-wrap select,
    .textarea-wrap textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #ddd8d0;
        border-radius: 12px;
        background: #fffdfa;
        color: #263330;
        font: inherit;
        outline: none;
        transition: .2s ease;
    }

    .input-wrap input,
    .input-wrap select {
        height: 50px;
        padding: 0 15px 0 44px;
    }

    .textarea-wrap textarea {
        min-height: 145px;
        padding: 15px 15px 15px 44px;
        resize: vertical;
    }

    .input-wrap input:focus,
    .input-wrap select:focus,
    .textarea-wrap textarea:focus {
        border-color: #16302e;
        box-shadow: 0 0 0 3px rgba(22, 48, 46, .08);
    }

    .error {
        display: block;
        margin-top: 6px;
        color: #c0392b;
        font-size: 12px;
    }

    .contact-submit {
        width: 100%;
        border: 0;
        border-radius: 12px;
        min-height: 52px;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: #16302e;
        color: #fff8ee;
        font: inherit;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .contact-submit:hover {
        background: #214541;
        transform: translateY(-1px);
    }

    .form-note {
        display: flex;
        align-items: flex-start;
        gap: 7px;
        margin: 14px 0 0;
        color: #858c89;
        font-size: 12px;
        line-height: 1.5;
    }

    .alert-success {
        display: flex;
        gap: 12px;
        margin-bottom: 25px;
        padding: 15px;
        border-radius: 12px;
        background: #edf7ef;
        color: #28653a;
    }

    .alert-success>i {
        font-size: 20px;
    }

    .alert-success strong {
        display: block;
        margin-bottom: 3px;
    }

    .alert-success p {
        margin: 0;
        font-size: 13px;
    }

    @media (max-width: 850px) {
        .contact-page {
            padding: 55px 16px;
        }

        .contact-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .contact-header h2 {
            letter-spacing: -1px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .contact-form-card {
            padding: 22px;
            border-radius: 18px;
        }

        .info-card {
            padding: 20px;
        }
    }
</style>
@endsection