<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register — Sahayika</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--ink:#16302E;--paper:#FBF5EA;--gold:#E8A33D;--teal:#2F6E68;--card:#FFFDF8;--line:rgba(22,48,46,.13);--red:#A63446}
*{box-sizing:border-box}body{margin:0;background:var(--paper);color:var(--ink);font-family:Inter,sans-serif}.page{min-height:100vh;display:grid;grid-template-columns:.8fr 1.2fr}.aside{background:linear-gradient(160deg,#16302E,#0e2523);color:#fff8ee;padding:48px;display:flex;flex-direction:column;justify-content:space-between}.brand{font:700 1.5rem Fraunces,serif}.aside h1{font:600 clamp(2rem,4vw,3.3rem) Fraunces,serif;line-height:1.1;margin:25px 0 16px}.aside h1 em{color:var(--gold)}.aside p{color:#fff8eeb8;line-height:1.7;max-width:450px}.points{display:grid;gap:14px}.point{padding:15px;border:1px solid #ffffff24;background:#ffffff0b;border-radius:14px}.point b{display:block}.point span{font-size:.84rem;color:#fff8ee99}.main{padding:36px 28px;display:flex;justify-content:center}.card{width:100%;max-width:720px}.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}.top a{font-size:.9rem;color:#596b68}.h{font:600 2.1rem Fraunces,serif;margin:0 0 6px}.sub{color:#647572;margin:0 0 24px}.roles{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:22px}.role{border:1.5px solid var(--line);background:var(--card);border-radius:14px;padding:15px;text-align:left;cursor:pointer;color:var(--ink)}.role.active{border-color:var(--teal);background:#eef5f2}.role b{display:block}.role span{font-size:.8rem;color:#697b78}.grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}.field{margin-bottom:14px}.field label{display:block;font-size:.83rem;font-weight:700;margin-bottom:7px}.field input,.field select,.field textarea{width:100%;padding:12px 13px;border:1.5px solid var(--line);border-radius:11px;background:var(--card);font:inherit;color:var(--ink);outline:none}.field textarea{min-height:90px;resize:vertical}.field input:focus,.field select:focus,.field textarea:focus{border-color:var(--teal)}.helper{display:none}.helper.show{display:block}.services{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;margin-top:8px}.service{border:1px solid var(--line);border-radius:10px;padding:9px;background:var(--card);font-size:.84rem}.service input{width:auto;margin-right:7px}.terms{font-size:.8rem;color:#63716f;margin:10px 0 16px}.terms input{width:auto}.btn{width:100%;border:0;border-radius:100px;padding:14px;background:var(--gold);color:var(--ink);font-weight:800;font-size:.95rem;cursor:pointer}.errors{background:#fff0f0;border:1px solid #e6b8b8;color:#8a2938;border-radius:12px;padding:12px 15px;margin-bottom:18px;font-size:.86rem}.note{font-size:.76rem;color:#71807d;margin-top:10px}.flash{background:#edf7f0;border:1px solid #b9dbc4;color:#28603a;padding:10px 14px;border-radius:10px;margin-bottom:16px}@media(max-width:850px){.page{grid-template-columns:1fr}.aside{display:none}}@media(max-width:560px){.grid,.roles,.services{grid-template-columns:1fr}.main{padding:25px 16px}.h{font-size:1.75rem}}
</style>
</head>
<body>
<div class="page">
<aside class="aside">
  <a class="brand" href="{{ route('home') }}">Sahayika</a>
  <div>
    <div style="color:#E8A33D;font-size:.78rem;font-weight:700;letter-spacing:.12em">घर की मदद • INDORE</div>
    <h1>अपने घर के काम के लिए <em>सही मदद</em> ढूंढें।</h1>
    <p>घर के काम, खाना, बच्चों या बुजुर्गों की देखभाल के लिए अपना profile बनाएं। सहायिका के रूप में काम ढूंढ रहे हैं तो अपनी services और उपलब्ध समय बताएं।</p>
    <div class="points">
      <div class="point"><b>Customer / Household</b><span>अपने area में उपलब्ध helpers खोजने के लिए।</span></div>
      <div class="point"><b>Helper / Sahayika</b><span>अपनी services, experience और availability दिखाने के लिए।</span></div>
    </div>
  </div>
  <small style="color:#fff8ee80">Demo development app • Sahayika</small>
</aside>
<main class="main"><div class="card">
  <div class="top"><a href="{{ route('home') }}">← Sahayika</a><a href="{{ route('login') }}">Already registered? Login</a></div>
  <h1 class="h">Sahayika पर जुड़ें</h1><p class="sub">पहले बताएं कि आप किस तरह का account बनाना चाहते हैं।</p>

  @if($errors->any())<div class="errors"><strong>कृपया ये details ठीक करें:</strong><ul style="margin:7px 0 0 18px">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

  <div class="roles">
    <button type="button" class="role {{ old('role','customer')==='customer'?'active':'' }}" onclick="setRole('customer',this)"><b>🏠 Customer / Household</b><span>घर के लिए सहायिका खोजें</span></button>
    <button type="button" class="role {{ old('role')==='helper'?'active':'' }}" onclick="setRole('helper',this)"><b>🤝 Helper / Sahayika</b><span>काम और services के लिए profile बनाएं</span></button>
  </div>

  <form method="POST" action="{{ route('register.store') }}">
    @csrf
    <input type="hidden" name="role" id="role" value="{{ old('role','customer') }}">
    <div class="grid">
      <div class="field"><label for="name">पूरा नाम</label><input id="name" name="name" value="{{ old('name') }}" placeholder="जैसे Neha Sharma" required></div>
      <div class="field"><label for="phone">Mobile number</label><input id="phone" name="phone" value="{{ old('phone') }}" placeholder="Demo/valid mobile number" required></div>
    </div>
    <div class="field"><label for="email">Email</label><input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"></div>

    <div class="grid">
      <div class="field"><label for="locality_id">Indore locality</label>
        <select id="locality_id" name="locality_id"><option value="">Locality चुनें</option>@foreach($localities as $locality)<option value="{{ $locality->id }}" @selected(old('locality_id')==$locality->id)>{{ $locality->name }}</option>@endforeach</select>
      </div>
      <div class="field"><label for="pincode">Pincode</label><input id="pincode" name="pincode" value="{{ old('pincode') }}" placeholder="4520xx"></div>
    </div>
    <div class="field"><label for="address_line">Area / address</label><input id="address_line" name="address_line" value="{{ old('address_line') }}" placeholder="Fictional/demo address or locality"></div>

    <section id="helperFields" class="helper {{ old('role')==='helper'?'show':'' }}">
      <div class="grid">
        <div class="field"><label for="gender">Gender</label><select id="gender" name="gender"><option value="">Select</option><option value="female" @selected(old('gender')==='female')>Female</option><option value="male" @selected(old('gender')==='male')>Male</option><option value="other" @selected(old('gender')==='other')>Other</option><option value="prefer_not_to_say" @selected(old('gender')==='prefer_not_to_say')>Prefer not to say</option></select></div>
        <div class="field"><label for="date_of_birth">Date of birth <span style="font-weight:400">(optional)</span></label><input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"></div>
      </div>
      <div class="grid">
        <div class="field"><label for="experience_years">Experience (years)</label><input id="experience_years" type="number" min="0" max="60" name="experience_years" value="{{ old('experience_years',0) }}"></div>
        <div class="field"><label for="expected_salary">Expected salary</label><input id="expected_salary" type="number" min="0" name="expected_salary" value="{{ old('expected_salary') }}" placeholder="₹ per selected period"></div>
      </div>
      <div class="grid">
        <div class="field"><label for="work_type">Work type</label><select id="work_type" name="work_type"><option value="part_time" @selected(old('work_type','part_time')==='part_time')>Part-time</option><option value="full_time" @selected(old('work_type')==='full_time')>Full-time</option></select></div>
        <div class="field"><label for="salary_type">Salary type</label><select id="salary_type" name="salary_type"><option value="monthly">Monthly</option><option value="daily">Daily</option><option value="hourly">Hourly</option></select></div>
      </div>
      <div class="field"><label>आप कौन-सी services दे सकती/सकते हैं?</label><div class="services">@foreach($services as $service)<label class="service"><input type="checkbox" name="service_ids[]" value="{{ $service->id }}" @checked(in_array($service->id, old('service_ids',[])))> {{ $service->name_hi ?: $service->name }}</label>@endforeach</div></div>
      <div class="field"><label for="languages">Languages</label><input id="languages" name="languages" value="{{ old('languages','Hindi') }}" placeholder="Hindi, Basic English"></div>
      <div class="field"><label for="bio">About / experience</label><textarea id="bio" name="bio" placeholder="अपने काम और experience के बारे में बताएं">{{ old('bio') }}</textarea></div>
      <label class="terms"><input type="checkbox" name="immediate_availability" value="1" @checked(old('immediate_availability',true))> अभी काम के लिए available हूँ</label>
    </section>

    <div class="grid">
      <div class="field"><label for="password">Password</label><input id="password" type="password" name="password" placeholder="कम से कम 8 characters" required></div>
      <div class="field"><label for="password_confirmation">Confirm password</label><input id="password_confirmation" type="password" name="password_confirmation" required></div>
    </div>
    <label class="terms"><input type="checkbox" required> मैं समझता/समझती हूँ कि यह account development/demo environment के लिए हो सकता है और सही जानकारी देना मेरी जिम्मेदारी है।</label>
    <button class="btn" type="submit">Account बनाएं</button>
    <p class="note">हम Aadhaar, PAN, bank details या identity documents registration में नहीं मांग रहे हैं।</p>
  </form>
</div></main>
</div>
<script>
function setRole(role, button){
 document.getElementById('role').value=role;
 document.querySelectorAll('.role').forEach(x=>x.classList.remove('active')); button.classList.add('active');
 document.getElementById('helperFields').classList.toggle('show', role==='helper');
 document.querySelectorAll('#helperFields input,#helperFields select,#helperFields textarea').forEach(el=>el.disabled=role!=='helper');
}
setRole(document.getElementById('role').value, document.querySelector('.role.active'));
</script>
</body>
</html>
