<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Sahayika</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--ink:#16302E;--paper:#FBF5EA;--gold:#E8A33D;--teal:#2F6E68;--card:#FFFDF8;--line:rgba(22,48,46,.13);--red:#A63446}
*{box-sizing:border-box}body{margin:0;background:var(--paper);color:var(--ink);font-family:Inter,sans-serif}.page{min-height:100vh;display:grid;grid-template-columns:1fr 1fr}.aside{background:linear-gradient(160deg,#16302E,#0e2523);color:#fff8ee;padding:52px;display:flex;flex-direction:column;justify-content:space-between}.brand{font:700 1.5rem Fraunces,serif}.aside h1{font:600 clamp(2.2rem,4vw,3.5rem) Fraunces,serif;line-height:1.08}.aside em{color:var(--gold)}.aside p{color:#fff8eeb8;line-height:1.7;max-width:430px}.chips{display:flex;flex-wrap:wrap;gap:8px}.chip{padding:8px 12px;border:1px solid #ffffff24;border-radius:100px;background:#ffffff0a;font-size:.82rem}.main{display:flex;align-items:center;justify-content:center;padding:30px}.card{width:100%;max-width:420px}.top{display:flex;justify-content:space-between;margin-bottom:30px}.top a{font-size:.9rem;color:#647572}.h{font:600 2.2rem Fraunces,serif;margin:0 0 7px}.sub{color:#687975;margin:0 0 25px}.roles{display:grid;grid-template-columns:repeat(3,1fr);gap:7px;margin-bottom:22px}.role{border:1.5px solid var(--line);background:var(--card);border-radius:10px;padding:10px 5px;font-size:.78rem;font-weight:700;color:var(--ink);cursor:pointer}.role.active{background:var(--ink);color:var(--paper);border-color:var(--ink)}.field{margin-bottom:15px}.field label{display:block;font-size:.83rem;font-weight:700;margin-bottom:7px}.field input{width:100%;padding:13px;border:1.5px solid var(--line);border-radius:11px;background:var(--card);font:inherit;outline:none}.field input:focus{border-color:var(--teal)}.row{display:flex;justify-content:space-between;align-items:center;font-size:.82rem;color:#667571;margin:8px 0 20px}.row label{display:flex;gap:7px;align-items:center}.btn{width:100%;padding:14px;border:0;border-radius:100px;background:var(--gold);font-weight:800;color:var(--ink);cursor:pointer}.errors{background:#fff0f0;border:1px solid #e6b8b8;color:#8a2938;border-radius:12px;padding:12px 15px;margin-bottom:18px;font-size:.86rem}.demo{margin-top:22px;padding:14px;border:1px dashed var(--line);border-radius:12px;background:#ffffff70;font-size:.78rem;line-height:1.6;color:#5e6d6a}.demo b{color:var(--ink)}@media(max-width:800px){.page{grid-template-columns:1fr}.aside{display:none}}
</style>
</head>
<body>
<div class="page">
<aside class="aside">
<a class="brand" href="{{ route('home') }}">Sahayika</a>
<div><div style="color:#E8A33D;font-size:.78rem;font-weight:700;letter-spacing:.12em">घर की मदद • INDORE</div><h1>फिर से मिलिए <em>अपनी Sahayika</em> से।</h1><p>Customer के लिए घर के काम की मदद खोजें। Helper के लिए अपना profile, services और availability manage करने की शुरुआत करें।</p><div class="chips"><span class="chip">झाड़ू-पोंछा</span><span class="chip">बर्तन</span><span class="chip">खाना</span><span class="chip">Baby Care</span><span class="chip">Elder Care</span><span class="chip">All-rounder</span></div></div>
<small style="color:#fff8ee80">Demo development app • Sahayika</small>
</aside>
<main class="main"><div class="card">
<div class="top"><a href="{{ route('home') }}">← Sahayika</a><a href="{{ route('register') }}">Create account</a></div>
<h1 class="h">Welcome back</h1><p class="sub">अपना account type चुनें और login करें।</p>
@if($errors->any())<div class="errors"><ul style="margin:0 0 0 18px">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ route('login.store') }}">
@csrf
<div class="roles">
<button type="button" class="role {{ old('role','customer')==='customer'?'active':'' }}" onclick="setRole('customer',this)">🏠 Customer</button>
<button type="button" class="role {{ old('role')==='helper'?'active':'' }}" onclick="setRole('helper',this)">🤝 Helper</button>
<button type="button" class="role {{ old('role')==='admin'?'active':'' }}" onclick="setRole('admin',this)">⚙️ Admin</button>
</div>
<input type="hidden" name="role" id="role" value="{{ old('role','customer') }}">
<div class="field"><label for="identifier">Email या mobile number</label><input id="identifier" name="identifier" value="{{ old('identifier') }}" placeholder="demo.customer01@sahayika.test" required></div>
<div class="field"><label for="password">Password</label><input id="password" type="password" name="password" placeholder="Your password" required></div>
<div class="row"><label><input type="checkbox" name="remember" value="1"> Remember me</label><span>Secure session</span></div>
<button class="btn" type="submit">Login करें</button>
</form>
<div class="demo"><b>Demo accounts</b><br>Admin: admin@sahayika.test / Demo@12345<br>Customer: demo.customer01@sahayika.test / Demo@12345<br>Helper: demo.helper01@sahayika.test / Demo@12345</div>
</div></main>
</div>
<script>
function setRole(role,button){document.getElementById('role').value=role;document.querySelectorAll('.role').forEach(x=>x.classList.remove('active'));button.classList.add('active')}
</script>
</body>
</html>
