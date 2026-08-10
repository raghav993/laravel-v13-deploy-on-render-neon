<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Create Account — Sahayika</title>
<link rel="icon" href="{{ asset('assets/img/favicon.ico') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--brand:#16302e;--cream:#fbf5ea}
body{font-family:Inter,sans-serif;background:linear-gradient(135deg,#f8f4ed,#eef7f5);color:#172b2a}
.card-shell{max-width:760px;margin:auto}
.form-control,.form-select{min-height:50px;border-radius:12px}
.form-control:focus,.form-select:focus{border-color:#2f6e68;box-shadow:0 0 0 .2rem rgba(47,110,104,.12)}
.role-btn{border:1px solid #dee2e6;border-radius:14px;background:#fff;text-align:left;min-height:76px}
.role-btn.active{border-color:#2f6e68!important;background:#eef8f5!important;box-shadow:0 0 0 2px rgba(47,110,104,.08)}
.step{width:30px;height:30px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;background:#e9f2f0;color:#285f59;font-weight:700}
.otp-box{letter-spacing:.55em;font-size:1.5rem;text-align:center;font-weight:700}
.dev-otp{background:#fff8dc;border:1px dashed #d7a900}
.helper{display:none}.helper.show{display:block}
@media(max-width:575.98px){body{background:#fff}.page{padding:0!important}.card-shell{width:100%}.register-card{border:0!important;box-shadow:none!important}.topbar{padding:16px 4px!important}.content{padding:20px 4px 28px!important}.role-grid{display:grid!important;grid-template-columns:1fr!important}.section-title{font-size:1rem}.btn-lg{min-height:52px}}
</style>
</head>
<body>
<div class="page container py-4 py-md-5">
<div class="card-shell">
<div class="register-card bg-white rounded-4 shadow-sm border overflow-hidden">
<div class="topbar d-flex justify-content-between align-items-center px-4 px-md-5 py-3 border-bottom">
<a href="{{ route('home') }}" class="text-decoration-none fw-bold text-dark"><i class="bi bi-arrow-left me-1"></i>Sahayika</a>
<a href="{{ route('login') }}" class="text-decoration-none fw-semibold small">Already registered? Login</a>
</div>
<div class="content p-4 p-md-5">
<div class="text-center mb-4">
<div class="step mb-2">1</div>
<h1 class="h3 fw-bold mb-1">Create your account</h1>
<p class="text-secondary mb-0">Mobile verify करें और अपना Sahayika account बनाएं.</p>
</div>

@if($errors->any())
<div class="alert alert-danger border-0 rounded-3"><strong>कृपया details ठीक करें:</strong><ul class="mb-0 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
@csrf
<input type="hidden" name="role" id="role" value="{{ old('role','customer') }}">

<div class="mb-4">
<label class="form-label fw-semibold">आप किस रूप में जुड़ना चाहते हैं?</label>
<div class="role-grid row g-2">
<div class="col-md-6"><button type="button" class="role-btn w-100 p-3 {{ old('role','customer')==='customer'?'active':'' }}" onclick="setRole('customer',this)"><i class="bi bi-house-heart fs-5 me-2"></i><strong>Customer</strong><span class="d-block small text-secondary ms-4">घर के लिए सहायिका खोजें</span></button></div>
<div class="col-md-6"><button type="button" class="role-btn w-100 p-3 {{ old('role')==='helper'?'active':'' }}" onclick="setRole('helper',this)"><i class="bi bi-person-heart fs-5 me-2"></i><strong>Helper / Sahayika</strong><span class="d-block small text-secondary ms-4">अपनी services के लिए profile बनाएं</span></button></div>
</div>
</div>

<div class="row g-3">
<div class="col-12"><label class="form-label fw-semibold" for="name">पूरा नाम</label><input class="form-control" id="name" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="जैसे Neha Sharma" required></div>
<div class="col-12">
<label class="form-label fw-semibold" for="phone">Mobile number</label>
<div class="input-group">
<span class="input-group-text bg-white">+91</span>
<input class="form-control" id="phone" name="phone" value="{{ old('phone') }}" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" autocomplete="tel" placeholder="10 digit mobile number" required>
<button class="btn btn-dark px-3" type="button" id="sendOtpBtn">Send OTP</button>
</div>
<div class="form-text">Demo mode: real SMS API अभी connect नहीं है.</div>
</div>
</div>

<div id="otpPanel" class="mt-3 d-none">
<div class="rounded-3 p-3 dev-otp">
<div class="d-flex justify-content-between align-items-center mb-2"><strong><i class="bi bi-shield-check me-1"></i>Verify mobile</strong><button type="button" id="resendOtp" class="btn btn-sm btn-link p-0" disabled>Resend OTP</button></div>
<p class="small text-secondary mb-2">OTP आपके mobile पर भेजा जाना है. अभी development mode में नीचे generated OTP दिखाया जा रहा है.</p>
<div id="demoOtp" class="fw-bold text-center fs-5 mb-2"></div>
<input class="form-control otp-box" id="otp" maxlength="4" inputmode="numeric" autocomplete="one-time-code" placeholder="••••" aria-label="4 digit OTP">
<div id="otpMessage" class="small mt-2"></div>
<button type="button" id="verifyOtpBtn" class="btn btn-success w-100 mt-2">Verify OTP</button>
</div>
</div>

<div id="afterVerify" class="mt-3 d-none">
<div class="alert alert-success py-2 mb-0"><i class="bi bi-check-circle-fill me-2"></i>Mobile number verified.</div>
</div>

<div class="mt-4">
<div class="section-title fw-bold mb-3"><span class="step me-2">2</span>Basic details</div>
<div class="row g-3">
<div class="col-12"><label class="form-label fw-semibold" for="email">Email <span class="text-secondary fw-normal">(optional)</span></label><input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com"></div>
<div class="col-md-6"><label class="form-label fw-semibold" for="locality_id">Indore locality</label><select class="form-select" id="locality_id" name="locality_id"><option value="">Locality चुनें</option>@foreach($localities as $locality)<option value="{{ $locality->id }}" @selected(old('locality_id')==$locality->id)>{{ $locality->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label fw-semibold" for="pincode">Pincode</label><input class="form-control" id="pincode" name="pincode" value="{{ old('pincode') }}" inputmode="numeric" maxlength="6" placeholder="4520xx"></div>
<div class="col-12"><label class="form-label fw-semibold" for="address_line">Area / address</label><input class="form-control" id="address_line" name="address_line" value="{{ old('address_line') }}" placeholder="Area / locality"></div>
</div>
</div>

<section id="helperFields" class="helper {{ old('role')==='helper'?'show':'' }}">
<hr class="my-4">
<div class="section-title fw-bold mb-3"><span class="step me-2">3</span>Helper profile</div>
<div class="row g-3">
<div class="col-md-6"><label class="form-label fw-semibold">Gender</label><select class="form-select" id="gender" name="gender"><option value="">Select</option><option value="female" @selected(old('gender')==='female')>Female</option><option value="male" @selected(old('gender')==='male')>Male</option><option value="other" @selected(old('gender')==='other')>Other</option><option value="prefer_not_to_say" @selected(old('gender')==='prefer_not_to_say')>Prefer not to say</option></select></div>
<div class="col-md-6"><label class="form-label fw-semibold">Date of birth <span class="fw-normal text-secondary">(optional)</span></label><input class="form-control" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"></div>
<div class="col-md-6"><label class="form-label fw-semibold">Experience (years)</label><input class="form-control" type="number" min="0" max="60" name="experience_years" value="{{ old('experience_years',0) }}"></div>
<div class="col-md-6"><label class="form-label fw-semibold">Expected salary</label><input class="form-control" type="number" min="0" name="expected_salary" value="{{ old('expected_salary') }}" placeholder="₹ amount"></div>
<div class="col-md-6"><label class="form-label fw-semibold">Work type</label><select class="form-select" name="work_type"><option value="part_time">Part-time</option><option value="full_time" @selected(old('work_type')==='full_time')>Full-time</option></select></div>
<div class="col-md-6"><label class="form-label fw-semibold">Salary type</label><select class="form-select" name="salary_type"><option value="monthly">Monthly</option><option value="daily">Daily</option><option value="hourly">Hourly</option></select></div>
<div class="col-12"><label class="form-label fw-semibold">Services</label><div class="row row-cols-1 row-cols-md-2 g-2">@foreach($services as $service)<label class="form-check border rounded-3 p-2"><input class="form-check-input ms-0 me-2" type="checkbox" name="service_ids[]" value="{{ $service->id }}" @checked(in_array($service->id,old('service_ids',[])))> {{ $service->name_hi ?: $service->name }}</label>@endforeach</div></div>
<div class="col-12"><label class="form-label fw-semibold">Languages</label><input class="form-control" name="languages" value="{{ old('languages','Hindi') }}" placeholder="Hindi, Basic English"></div>
<div class="col-12"><label class="form-label fw-semibold">About / experience</label><textarea class="form-control" name="bio" rows="3" placeholder="अपने काम और experience के बारे में बताएं">{{ old('bio') }}</textarea></div>
<div class="col-12"><label class="form-check small text-secondary"><input class="form-check-input" type="checkbox" name="immediate_availability" value="1" @checked(old('immediate_availability',true))> अभी काम के लिए available हूँ</label></div>
</div>
</section>

<hr class="my-4">
<div class="section-title fw-bold mb-3"><span class="step me-2">4</span>Secure your account</div>
<div class="row g-3">
<div class="col-md-6"><label class="form-label fw-semibold">Password</label><input class="form-control" id="password" type="password" name="password" minlength="8" autocomplete="new-password" placeholder="कम से कम 8 characters" required></div>
<div class="col-md-6"><label class="form-label fw-semibold">Confirm password</label><input class="form-control" type="password" name="password_confirmation" autocomplete="new-password" required></div>
</div>
<div class="form-check mt-3 small text-secondary"><input class="form-check-input" type="checkbox" id="terms" required><label class="form-check-label" for="terms">मैं सही जानकारी देने और Sahayika की terms का पालन करने के लिए सहमत हूँ.</label></div>

<button class="btn btn-dark btn-lg w-100 rounded-3 mt-4 fw-bold" id="submitBtn" type="submit" disabled>Create account</button>
<p class="text-center text-secondary small mt-3 mb-0">Registration से पहले mobile verification जरूरी है.</p>
</form>
</div></div></div>

<script>
const phone=document.getElementById('phone'), otpPanel=document.getElementById('otpPanel'), otp=document.getElementById('otp'),
sendBtn=document.getElementById('sendOtpBtn'), verifyBtn=document.getElementById('verifyOtpBtn'), resend=document.getElementById('resendOtp'),
demoOtp=document.getElementById('demoOtp'), otpMessage=document.getElementById('otpMessage'), submitBtn=document.getElementById('submitBtn');
let generatedOtp='', verified=false, timer=null;

function setRole(role,button){
 document.getElementById('role').value=role;
 document.querySelectorAll('.role-btn').forEach(x=>x.classList.remove('active'));
 button.classList.add('active');
 const helper=role==='helper';
 document.getElementById('helperFields').classList.toggle('show',helper);
 document.querySelectorAll('#helperFields input,#helperFields select,#helperFields textarea').forEach(el=>el.disabled=!helper);
}
const activeRole=document.querySelector('.role-btn.active')||document.querySelector('.role-btn');
setRole(document.getElementById('role').value,activeRole);

function validPhone(){return /^[6-9]\d{9}$/.test(phone.value.trim())}
function createOtp(){return String(Math.floor(1000+Math.random()*9000))}
function startTimer(){
 let left=30; resend.disabled=true; resend.textContent=`Resend in ${left}s`;
 clearInterval(timer); timer=setInterval(()=>{left--; resend.textContent=left?`Resend in ${left}s`:'Resend OTP'; if(left<=0){clearInterval(timer);resend.disabled=false}},1000);
}
function sendOtp(){
 if(!validPhone()){phone.focus(); phone.classList.add('is-invalid'); return}
 phone.classList.remove('is-invalid');
 generatedOtp=createOtp(); verified=false; submitBtn.disabled=true;
 otpPanel.classList.remove('d-none'); document.getElementById('afterVerify').classList.add('d-none');
 demoOtp.textContent=`Demo OTP: ${generatedOtp}`;
 otp.value=''; otpMessage.textContent=''; startTimer(); otp.focus();
 // PRODUCTION SMS API — add your provider call here later.
 // Example: fetch('/api/send-otp', { method:'POST', headers:{'X-CSRF-TOKEN':document.querySelector('[name=_token]').value}, body:new FormData(document.getElementById('registerForm')) });
}
sendBtn.addEventListener('click',sendOtp);
resend.addEventListener('click',sendOtp);
otp.addEventListener('input',()=>{otp.value=otp.value.replace(/\D/g,'').slice(0,4)});
verifyBtn.addEventListener('click',()=>{
 if(otp.value.length!==4){otpMessage.className='small mt-2 text-danger';otpMessage.textContent='4 digit OTP enter करें.';return}
 if(otp.value===generatedOtp){
  verified=true; submitBtn.disabled=false; otpMessage.className='small mt-2 text-success'; otpMessage.textContent='OTP verified successfully.';
  document.getElementById('afterVerify').classList.remove('d-none'); verifyBtn.disabled=true;
 }else{otpMessage.className='small mt-2 text-danger';otpMessage.textContent='Invalid OTP. सही 4 digit OTP डालें.'}
});
document.getElementById('registerForm').addEventListener('submit',e=>{
 if(!verified){e.preventDefault(); otpPanel.classList.remove('d-none'); otpMessage.className='small mt-2 text-danger'; otpMessage.textContent='पहले mobile OTP verify करें.'}
});
</script>
</body></html>
