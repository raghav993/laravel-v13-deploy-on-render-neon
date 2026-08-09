<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register — Sahayika</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>body{font-family:Inter,sans-serif;background:#fbf5ea}.serif{font-family:Fraunces,serif}.helper{display:none}.helper.show{display:block}</style>
</head>
<body>
<div class="min-vh-100 d-flex align-items-center">
<div class="container py-4">
<div class="row g-0 justify-content-center shadow-lg rounded-4 overflow-hidden">
<div class="col-lg-4 d-none d-lg-flex text-white p-4 flex-column justify-content-between" style="background:linear-gradient(150deg,#16302e,#2f6e68)">
<div><a href="{{ route('home') }}"><img src="{{ asset('assets/img/light-logo.png') }}" alt="Sahayika" width="150"></a><br><span class="mt-2 badge rounded-pill bg-warning text-dark mt-5 mb-3">GET STARTED</span>
<h1 class="serif display-6 fw-bold">अपने घर के काम के लिए <span class="text-warning">सही मदद</span> ढूंढें।</h1>
<p class="text-white-50">Customer के लिए helper खोजें या Sahayika के साथ अपनी services और availability का profile बनाएं।</p>
<div class="vstack gap-2"><div class="bg-white bg-opacity-10 rounded-3 p-3"><i class="bi bi-house-heart me-2"></i><strong>Customer</strong><div class="small text-white-50">अपने area में helpers खोजें</div></div><div class="bg-white bg-opacity-10 rounded-3 p-3"><i class="bi bi-person-heart me-2"></i><strong>Helper</strong><div class="small text-white-50">अपनी services और experience दिखाएं</div></div></div></div>
<img src="{{ asset('assets/img/register-bg.jpeg') }}" class="rounded-4 w-100" style="object-fit:cover" alt="Sahayika">
</div>
<div class="col-lg-8 bg-white p-4 p-md-5">
<div class="d-flex justify-content-between mb-4"><a class="text-decoration-none text-secondary" href="{{ route('home') }}"><i class="bi bi-arrow-left"></i> Sahayika</a><a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Already registered? Login</a></div>
<span class="badge bg-success-subtle text-success-emphasis rounded-pill mb-2"><i class="bi bi-person-plus me-1"></i> Create account</span>
<h2 class="serif fw-bold mb-1">Sahayika पर जुड़ें</h2><p class="text-secondary mb-4">पहले बताएं कि आप किस तरह का account बनाना चाहते हैं।</p>
@if($errors->any())<div class="alert alert-danger border-0"><strong>कृपया details ठीक करें:</strong><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="row g-2 mb-4">
<button type="button" class="role col btn btn-outline-secondary text-start p-3 { old('role','customer')==='customer'?'active border-success bg-success-subtle':'' }" onclick="setRole('customer',this)"><b><i class="bi bi-house-heart me-1"></i> Customer / Household</b><span class="d-block small text-secondary">घर के लिए सहायिका खोजें</span></button>
<button type="button" class="role col btn btn-outline-secondary text-start p-3 { old('role')==='helper'?'active border-success bg-success-subtle':'' }" onclick="setRole('helper',this)"><b><i class="bi bi-person-heart me-1"></i> Helper / Sahayika</b><span class="d-block small text-secondary">काम और services के लिए profile बनाएं</span></button>
</div>

          @csrf
          <input class="form-control" type="hidden" name="role" id="role" value="{{ old('role','customer') }}">
          <div class="row g-3">
            <div class="mb-3"><label class="form-label fw-semibold" for="name">पूरा नाम</label><input class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="जैसे Neha Sharma" required></div>
            <div class="mb-3"><label class="form-label fw-semibold" for="phone">Mobile number</label><input class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Demo/valid mobile number" required></div>
          </div>
          <div class="mb-3"><label class="form-label fw-semibold" for="email">Email</label><input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"></div>

          <div class="row g-3">
            <div class="mb-3"><label class="form-label fw-semibold" for="locality_id">Indore locality</label>
              <select class="form-select" id="locality_id" name="locality_id">
                <option value="">Locality चुनें</option>@foreach($localities as $locality)<option value="{{ $locality->id }}" @selected(old('locality_id')==$locality->id)>{{ $locality->name }}</option>@endforeach
              </select>
            </div>
            <div class="mb-3"><label class="form-label fw-semibold" for="pincode">Pincode</label><input class="form-control" id="pincode" name="pincode" value="{{ old('pincode') }}" placeholder="4520xx"></div>
          </div>
          <div class="mb-3"><label class="form-label fw-semibold" for="address_line">Area / address</label><input class="form-control" id="address_line" name="address_line" value="{{ old('address_line') }}" placeholder="Fictional/demo address or locality"></div>

          <section id="helperFields" class="helper {{ old('role')==='helper'?'show':'' }}">
            <div class="row g-3">
              <div class="mb-3"><label class="form-label fw-semibold" for="gender">Gender</label><select class="form-select" id="gender" name="gender">
                  <option value="">Select</option>
                  <option value="female" @selected(old('gender')==='female' )>Female</option>
                  <option value="male" @selected(old('gender')==='male' )>Male</option>
                  <option value="other" @selected(old('gender')==='other' )>Other</option>
                  <option value="prefer_not_to_say" @selected(old('gender')==='prefer_not_to_say' )>Prefer not to say</option>
                </select></div>
              <div class="mb-3"><label class="form-label fw-semibold" for="date_of_birth">Date of birth <span style="font-weight:400">(optional)</span></label><input class="form-control" id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"></div>
            </div>
            <div class="row g-3">
              <div class="mb-3"><label class="form-label fw-semibold" for="experience_years">Experience (years)</label><input class="form-control" id="experience_years" type="number" min="0" max="60" name="experience_years" value="{{ old('experience_years',0) }}"></div>
              <div class="mb-3"><label class="form-label fw-semibold" for="expected_salary">Expected salary</label><input class="form-control" id="expected_salary" type="number" min="0" name="expected_salary" value="{{ old('expected_salary') }}" placeholder="₹ per selected period"></div>
            </div>
            <div class="row g-3">
              <div class="mb-3"><label class="form-label fw-semibold" for="work_type">Work type</label><select class="form-select" id="work_type" name="work_type">
                  <option value="part_time" @selected(old('work_type','part_time')==='part_time' )>Part-time</option>
                  <option value="full_time" @selected(old('work_type')==='full_time' )>Full-time</option>
                </select></div>
              <div class="mb-3"><label class="form-label fw-semibold" for="salary_type">Salary type</label><select class="form-select" id="salary_type" name="salary_type">
                  <option value="monthly">Monthly</option>
                  <option value="daily">Daily</option>
                  <option value="hourly">Hourly</option>
                </select></div>
            </div>
            <div class="mb-3"><label>आप कौन-सी services दे सकती/सकते हैं?</label>
              <div class="row row-cols-1 row-cols-md-2 g-2">@foreach($services as $service)<label class="form-check border rounded p-2 bg-light"><input class="form-check-input" type="checkbox" name="service_ids[]" value="{{ $service->id }}" @checked(in_array($service->id, old('service_ids',[])))> {{ $service->name_hi ?: $service->name }}</label>@endforeach</div>
            </div>
            <div class="mb-3"><label class="form-label fw-semibold" for="languages">Languages</label><input class="form-control" id="languages" name="languages" value="{{ old('languages','Hindi') }}" placeholder="Hindi, Basic English"></div>
            <div class="mb-3"><label class="form-label fw-semibold" for="bio">About / experience</label><textarea class="form-control" id="bio" name="bio" placeholder="अपने काम और experience के बारे में बताएं">{{ old('bio') }}</textarea></div>
            <label class="form-check small text-secondary mb-3"><input class="form-check-input" type="checkbox" name="immediate_availability" value="1" @checked(old('immediate_availability',true))> अभी काम के लिए available हूँ</label>
          </section>

          <div class="row g-3">
            <div class="mb-3"><label class="form-label fw-semibold" for="password">Password</label><input class="form-control" id="password" type="password" name="password" placeholder="कम से कम 8 characters" required></div>
            <div class="mb-3"><label class="form-label fw-semibold" for="password_confirmation">Confirm password</label><input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required></div>
          </div>
          <label class="form-check small text-secondary mb-3"><input class="form-check-input" type="checkbox" required> मैं समझता/समझती हूँ कि यह account development/demo environment के लिए हो सकता है और सही जानकारी देना मेरी जिम्मेदारी है।</label>
          <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold" type="submit">Account बनाएं</button>
          <p class="note">हम Aadhaar, PAN, bank details या identity documents registration में नहीं मांग रहे हैं।</p>
        
</div></div></div></div>
<script>
function setRole(role,button){document.getElementById('role').value=role;document.querySelectorAll('.role').forEach(x=>x.classList.remove('active','border-success','bg-success-subtle'));button.classList.add('active','border-success','bg-success-subtle');document.getElementById('helperFields').classList.toggle('show',role==='helper');document.querySelectorAll('#helperFields input,#helperFields select,#helperFields textarea').forEach(el=>el.disabled=role!=='helper')}
setRole(document.getElementById('role').value,document.querySelector('.role.active'));
</script>
</body></html>