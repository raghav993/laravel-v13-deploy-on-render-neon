<!DOCTYPE html>
<html lang="hi">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Sahayika</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>body{font-family:Inter,sans-serif;background:#fbf5ea}.serif{font-family:Fraunces,serif}</style>
</head>
<body>
<div class="min-vh-100 d-flex align-items-center">
  <div class="container py-4">
    <div class="row g-0 justify-content-center shadow-lg rounded-4 overflow-hidden">
      <div class="col-lg-5 d-none d-lg-flex text-white p-5 flex-column justify-content-between" style="background:linear-gradient(150deg,#16302e,#2f6e68)">
        <div><a href="{{ route('home') }}"><img src="{{ asset('assets/img/light-logo.png') }}" alt="Sahayika" width="160"></a>
          <span class="badge rounded-pill bg-warning text-dark mt-5 mb-3">घर की मदद • INDORE</span>
          <h1 class="serif display-5 fw-bold">फिर से मिलिए <span class="text-warning">अपनी Sahayika</span> से।</h1>
          <p class="text-white-50 fs-6">घर के काम, खाना, baby care या elder care के लिए मदद खोजें और अपने area में available profiles देखें।</p>
          <div class="d-flex flex-wrap gap-2"><span class="badge rounded-pill bg-white bg-opacity-10 border p-2">झाड़ू-पोंछा</span><span class="badge rounded-pill bg-white bg-opacity-10 border p-2">बर्तन</span><span class="badge rounded-pill bg-white bg-opacity-10 border p-2">खाना</span><span class="badge rounded-pill bg-white bg-opacity-10 border p-2">Elder Care</span></div>
        </div>
        <div class="rounded-4 overflow-hidden mt-4"><img src="{{ asset('assets/img/testimonials/1.png') }}" class="w-100" style="height:190px;object-fit:cover;" alt="Sahayika home support"></div>
      </div>
      <div class="col-lg-7 bg-white p-4 p-md-5">
        <div class="d-flex justify-content-between mb-4"><a class="text-decoration-none text-secondary" href="{{ route('home') }}"><i class="bi bi-arrow-left"></i> Sahayika</a><a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Create account</a></div>
        <div class="mb-4"><span class="badge bg-success-subtle text-success-emphasis rounded-pill mb-2"><i class="bi bi-person-check me-1"></i> Welcome back</span><h2 class="serif fw-bold mb-1">अपने account में login करें</h2><p class="text-secondary mb-0">Account type चुनें और आगे बढ़ें।</p></div>
        @if($errors->any())
        <div class="alert alert-danger border-0"><i class="bi bi-exclamation-circle me-2"></i><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('login.store') }}">
          @csrf
          <div class="row g-2 mb-3">
            <div class="col-md-4"><button type="button" class="role btn btn-outline-secondary w-100 text-start p-3 {{ old('role','customer')==='customer'?'active border-success bg-success-subtle':'' }}" onclick="setRole('customer',this)"><i class="bi bi-house-heart me-1"></i> Customer</button></div>
            <div class="col-md-4"><button type="button" class="role btn btn-outline-secondary w-100 text-start p-3 {{ old('role')==='helper'?'active border-success bg-success-subtle':'' }}" onclick="setRole('helper',this)"><i class="bi bi-person-heart me-1"></i> Helper</button></div>
            <div class="col-md-4"><button type="button" class="role btn btn-outline-secondary w-100 text-start p-3 {{ old('role')==='admin'?'active border-success bg-success-subtle':'' }}" onclick="setRole('admin',this)"><i class="bi bi-gear me-1"></i> Admin</button></div>
          </div>
          <input type="hidden" name="role" id="role" value="{{ old('role','customer') }}">
          <div class="mb-3"><label for="identifier" class="form-label fw-semibold">Email या mobile number</label><div class="input-group"><span class="input-group-text"><i class="bi bi-person"></i></span><input class="form-control" id="identifier" name="identifier" value="{{ old('identifier') }}" placeholder="demo.customer01@sahayika.test" required></div></div>
          <div class="mb-3"><label for="password" class="form-label fw-semibold">Password</label><div class="input-group"><span class="input-group-text"><i class="bi bi-lock"></i></span><input class="form-control" id="password" type="password" name="password" placeholder="Your password" required></div></div>
          <div class="d-flex justify-content-between align-items-center small text-secondary mb-4"><label class="form-check"><input class="form-check-input" type="checkbox" name="remember" value="1"><span class="form-check-label">Remember me</span></label><span><i class="bi bi-shield-check text-success"></i> Secure session</span></div>
          <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold" type="submit"><i class="bi bi-box-arrow-in-right me-2"></i>Login करें</button>
        </form>
        <div class="alert alert-light border mt-4 small"><strong><i class="bi bi-info-circle me-1"></i> Demo accounts</strong><br>Admin: admin@sahayika.test / Demo@12345<br>Customer: demo.customer01@sahayika.test / Demo@12345<br>Helper: demo.helper01@sahayika.test / Demo@12345</div>
      </div>
    </div>
  </div>
</div>
<script>
function setRole(role,button){document.getElementById('role').value=role;document.querySelectorAll('.role').forEach(x=>x.classList.remove('active','border-success','bg-success-subtle'));button.classList.add('active','border-success','bg-success-subtle')}
</script>
</body></html>
