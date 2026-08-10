@extends('layouts.app')

@section('title', 'काम के लिए Register करें — Sahayika')

@section('content')
<section class="form-hero"><div class="container"><span class="eyebrow">FOR LOCAL PROFESSIONALS</span><h1>अपने काम का professional profile बनाएं.</h1><p>Customer को साफ दिखाएं कि आप क्या काम करते हैं, कहाँ service देते हैं और कितने experience के साथ काम करते हैं।</p></div></section>
<section class="section form-section">
<div class="container form-layout">
    <div class="form-card">
        <div class="form-title"><span class="step-badge">01</span><div><h2>Basic profile</h2><p>ये details customer आपके profile पर देखेगा।</p></div></div>
        <form method="POST" action="{{ route('workers.store') }}" class="clean-form">
            @csrf
            <div class="field-grid">
                <label>पूरा नाम <input name="name" value="{{ old('name') }}" required placeholder="जैसे Rakesh Kumar"></label>
                <label>Mobile number <input name="phone" value="{{ old('phone') }}" required inputmode="tel" placeholder="10 digit mobile"></label>
                <label>आपका काम <select name="category" required><option value="">Select service</option>@foreach($categories as $key=>$label)<option value="{{ $key }}" @selected(old('category')===$key)>{{ $label }}</option>@endforeach</select></label>
                <label>City <input name="city" value="{{ old('city') }}" required placeholder="जैसे Indore"></label>
                <label>Area / Locality <input name="area" value="{{ old('area') }}" placeholder="जैसे Vijay Nagar"></label>
                <label>Experience (years) <input type="number" name="experience_years" min="0" max="60" value="{{ old('experience_years', 1) }}" required></label>
                <label>Service type <select name="service_type" required><option value="on_demand">On demand / Per visit</option><option value="part_time">Part-time</option><option value="full_time">Full-time</option></select></label>
                <label>Approx. hourly rate <input type="number" name="hourly_rate" min="0" step="50" value="{{ old('hourly_rate') }}" placeholder="₹ e.g. 300"></label>
            </div>
            <label>Skills <input name="skills" value="{{ old('skills') }}" placeholder="Comma separated — wiring, fan repair, switch board"></label>
            <label>About your work <textarea name="bio" rows="4" placeholder="आप कौन-कौन से काम करते हैं? कौन से area में service देते हैं?">{{ old('bio') }}</textarea></label>
            <div class="form-note">Profile publish होने के बाद customers इसे search करके booking request भेज सकते हैं। Sensitive personal information यहाँ न डालें।</div>
            <button class="btn btn-primary btn-wide">Profile Publish करें <span>→</span></button>
        </form>
    </div>
    <aside class="side-info">
        <div class="side-card dark"><span class="side-icon">↗</span><h3>एक अच्छा profile क्या दिखाता है?</h3><ul><li>Clear service category</li><li>Experience और skills</li><li>Service area</li><li>Availability</li><li>Customer booking request</li></ul></div>
        <div class="side-card"><span class="eyebrow">TIP</span><h3>Skills में specific रहें</h3><p>“Electrician” के साथ “fan repair, wiring, switch board” जैसे skills लिखने से customer को आपकी service जल्दी समझ आती है।</p></div>
    </aside>
</div>
</section>
@endsection
