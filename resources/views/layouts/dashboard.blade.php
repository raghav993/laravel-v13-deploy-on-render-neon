<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $title ?? 'Dashboard' }} · Sahayika</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body{background:#f8f5ee}.sidebar{min-height:100vh;background:#16302e}.sidebar a{color:#dce9e6;text-decoration:none}.sidebar .nav-link{border-radius:.65rem;padding:.65rem .8rem}.sidebar .nav-link:hover,.sidebar .nav-link.active{background:#2f6e68;color:#fff}.brand{font-weight:800;color:#f8d48a}.stat{border:0;border-radius:1rem}.avatar{width:46px;height:46px;object-fit:cover}.content{min-width:0}.table>:not(caption)>*>*{padding:.8rem}.card{border:1px solid rgba(22,48,46,.08);border-radius:1rem}.btn-primary{--bs-btn-bg:#2f6e68;--bs-btn-border-color:#2f6e68}.btn-warning{--bs-btn-bg:#e8a33d;--bs-btn-border-color:#e8a33d;color:#16302e}.text-brand{color:#2f6e68}.bg-brand{background:#2f6e68}.small-label{font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:#71807d}
</style>
</head>
<body>
<div class="container-fluid"><div class="row">
<aside class="col-lg-2 col-md-3 sidebar p-3 d-none d-md-block">
<a href="{{ route('home') }}" class="text-decoration-none fs-4 brand d-block mb-4">Sahayika</a>
<div class="text-white-50 small mb-2">{{ ucfirst(auth()->user()->role) }} panel</div>
<nav class="nav flex-column gap-1">
<a class="nav-link {{ request()->routeIs('dashboard.index')?'active':'' }}" href="{{ route('dashboard.index') }}"><i class="bi bi-grid me-2"></i>Dashboard</a>
<a class="nav-link {{ request()->routeIs('dashboard.profile*')?'active':'' }}" href="{{ route('dashboard.profile') }}"><i class="bi bi-person me-2"></i>My Profile</a>
@if(auth()->user()->isCustomer())
<a class="nav-link" href="{{ route('helpers.index') }}"><i class="bi bi-search me-2"></i>Find Helpers</a>
<a class="nav-link" href="{{ route('dashboard.index') }}#bookings"><i class="bi bi-calendar-check me-2"></i>My Bookings</a>
<a class="nav-link" href="{{ route('dashboard.index') }}#favorites"><i class="bi bi-heart me-2"></i>Favourites</a>
@elseif(auth()->user()->isHelper())
<a class="nav-link" href="{{ route('dashboard.index') }}#bookings"><i class="bi bi-calendar-check me-2"></i>Job Requests</a>
<a class="nav-link" href="{{ route('dashboard.index') }}#services"><i class="bi bi-tools me-2"></i>My Services</a>
<a class="nav-link" href="{{ route('dashboard.index') }}#remarks"><i class="bi bi-star me-2"></i>Customer Remarks</a>
@else
<div class="small-label text-white-50 mt-3 mb-1">Management</div>
<a class="nav-link" href="{{ route('dashboard.admin.users') }}"><i class="bi bi-people me-2"></i>Users</a>
<a class="nav-link" href="{{ route('dashboard.admin.services') }}"><i class="bi bi-boxes me-2"></i>Services</a>
<a class="nav-link" href="{{ route('dashboard.admin.bookings') }}"><i class="bi bi-calendar2-week me-2"></i>Bookings</a>
<a class="nav-link" href="{{ route('dashboard.admin.testimonials') }}"><i class="bi bi-chat-quote me-2"></i>Testimonials</a>
<a class="nav-link" href="{{ route('dashboard.admin.settings') }}"><i class="bi bi-sliders me-2"></i>Site Settings</a>
@endif
</nav>
<form method="POST" action="{{ route('logout') }}" class="mt-4">@csrf<button class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right me-2"></i>Logout</button></form>
</aside>
<main class="col-lg-10 col-md-9 content px-3 px-lg-4 py-3">
<div class="d-flex justify-content-between align-items-center mb-4">
<div><div class="small text-muted">Sahayika Marketplace</div><h4 class="mb-0 fw-bold">@yield('heading','Dashboard')</h4></div>
<div class="dropdown"><button class="btn btn-light border dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}</button><ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item" href="{{ route('dashboard.profile') }}">Profile</a></li><li><hr class="dropdown-divider"></li><li><form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item">Logout</button></form></li></ul></div>
</div>
@if(session('success'))<div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}<button class="btn-close" data-bs-dismiss="alert"></button></div>@endif
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
@yield('content')
</main></div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
