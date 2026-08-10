<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title ?? 'Dashboard' }} · Sahayika</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root{--brand:#2f6e68;--brand-dark:#16302e;--page:#f6f7f8;--border:rgba(22,48,46,.10)}
html{scroll-behavior:smooth}
body{background:var(--page);color:#1e2b2a;overflow-x:hidden}
.sidebar{min-height:100vh;background:var(--brand-dark)}
.sidebar .brand{font-weight:800;color:#f8d48a}
.sidebar .nav-link{color:#dce9e6;text-decoration:none;border-radius:.7rem;padding:.65rem .8rem;transition:.15s}
.sidebar .nav-link:hover,.sidebar .nav-link.active{background:#2f6e68;color:#fff}
.sidebar .nav-section{font-size:.68rem;text-transform:uppercase;letter-spacing:.1em;color:#8da6a1;margin:1rem .8rem .35rem}
.content{min-width:0}
.card{border:1px solid var(--border);border-radius:1rem;box-shadow:0 2px 12px rgba(22,48,46,.035)}
.stat{border:0;border-radius:1rem}
.avatar{width:46px;height:46px;object-fit:cover}
.text-brand{color:var(--brand)!important}.bg-brand{background:var(--brand)!important}
.btn-primary{--bs-btn-bg:var(--brand);--bs-btn-border-color:var(--brand);--bs-btn-hover-bg:#255a55;--bs-btn-hover-border-color:#255a55}
.btn-warning{--bs-btn-bg:#e8a33d;--bs-btn-border-color:#e8a33d;color:#16302e}
.small-label{font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:#71807d}
.table>:not(caption)>*>*{padding:.8rem;vertical-align:middle}
.table thead th{font-size:.76rem;text-transform:uppercase;letter-spacing:.04em;color:#6c7b79;white-space:nowrap}
.dashboard-topbar{position:sticky;top:0;z-index:1020;background:rgba(246,247,248,.94);backdrop-filter:blur(10px);padding:.65rem 0}
.mobile-brand{font-weight:800;color:var(--brand-dark);text-decoration:none}
.mobile-nav .nav-link{color:#24403d;border-radius:.6rem}
.mobile-nav .nav-link:hover,.mobile-nav .nav-link.active{background:#e8f0ee;color:var(--brand)}
@media(max-width:767.98px){
 .content{padding-left:1rem!important;padding-right:1rem!important}
 .dashboard-topbar h4{font-size:1.05rem}
 .dashboard-topbar .small{display:none}
 .card{border-radius:.85rem}
 .table{font-size:.88rem}
}
</style>
@stack('styles')
</head>
<body>
<div class="container-fluid">
<div class="row flex-nowrap">
<aside class="col-lg-2 col-md-3 sidebar p-3 d-none d-md-flex flex-column">
<a href="{{ route('home') }}" class="text-decoration-none fs-4 brand d-block mb-4">Sahayika</a>
<div class="text-white-50 small mb-2">{{ ucfirst(auth()->user()->role) }} panel</div>
<nav class="nav flex-column gap-1">
<a class="nav-link {{ request()->routeIs('dashboard.index')?'active':'' }}" href="{{ route('dashboard.index') }}"><i class="bi bi-grid me-2"></i>Dashboard</a>
<a class="nav-link {{ request()->routeIs('dashboard.profile*')?'active':'' }}" href="{{ route('dashboard.profile') }}"><i class="bi bi-person me-2"></i>My Profile</a>
<a class="nav-link {{ request()->routeIs('dashboard.contacts*')?'active':'' }}" href="{{ route('dashboard.contacts.index') }}"><i class="bi bi-chat-dots me-2"></i>Secure Contacts</a>
@if(auth()->user()->isCustomer())
<div class="nav-section">Customer</div>
<a class="nav-link" href="{{ route('helpers.index') }}"><i class="bi bi-search me-2"></i>Find Helpers</a>
<a class="nav-link" href="{{ route('dashboard.index') }}#bookings"><i class="bi bi-calendar-check me-2"></i>My Bookings</a>
<a class="nav-link" href="{{ route('dashboard.index') }}#favorites"><i class="bi bi-heart me-2"></i>Favourites</a>
@elseif(auth()->user()->isHelper())
<div class="nav-section">Sahayika</div>
<a class="nav-link" href="{{ route('dashboard.index') }}#bookings"><i class="bi bi-calendar-check me-2"></i>Job Requests</a>
<a class="nav-link" href="{{ route('dashboard.index') }}#services"><i class="bi bi-tools me-2"></i>My Services</a>
<a class="nav-link" href="{{ route('dashboard.index') }}#remarks"><i class="bi bi-star me-2"></i>Customer Remarks</a>
@else
<div class="nav-section">Management</div>
<a class="nav-link {{ request()->routeIs('dashboard.admin.users*')?'active':'' }}" href="{{ route('dashboard.admin.users') }}"><i class="bi bi-people me-2"></i>Users</a>
<a class="nav-link {{ request()->routeIs('dashboard.admin.services*')?'active':'' }}" href="{{ route('dashboard.admin.services') }}"><i class="bi bi-boxes me-2"></i>Services</a>
<a class="nav-link {{ request()->routeIs('dashboard.admin.bookings*')?'active':'' }}" href="{{ route('dashboard.admin.bookings') }}"><i class="bi bi-calendar2-week me-2"></i>Bookings</a>
<a class="nav-link {{ request()->routeIs('dashboard.admin.testimonials*')?'active':'' }}" href="{{ route('dashboard.admin.testimonials') }}"><i class="bi bi-chat-quote me-2"></i>Testimonials</a>
<a class="nav-link {{ request()->routeIs('dashboard.admin.settings*')?'active':'' }}" href="{{ route('dashboard.admin.settings') }}"><i class="bi bi-sliders me-2"></i>Site Settings</a>
@endif
</nav>
<form method="POST" action="{{ route('logout') }}" class="mt-auto pt-4">@csrf<button class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right me-2"></i>Logout</button></form>
</aside>

<main class="col-lg-10 col-md-9 content px-3 px-lg-4 py-2 py-md-3">
<div class="dashboard-topbar">
<div class="d-flex justify-content-between align-items-center gap-2">
<div class="d-flex align-items-center gap-2">
<button class="btn btn-light border d-md-none" data-bs-toggle="offcanvas" data-bs-target="#mobileDashboardMenu" aria-label="Open menu"><i class="bi bi-list fs-5"></i></button>
<div><div class="small text-muted">Sahayika Marketplace</div><h4 class="mb-0 fw-bold">@yield('heading','Dashboard')</h4></div>
</div>
<div class="d-flex align-items-center gap-2">
<div class="dropdown">
<button class="btn btn-light border position-relative" data-bs-toggle="dropdown" aria-label="Notifications">
<i class="bi bi-bell"></i>
@php($unreadNotifications = auth()->user()->unreadNotifications()->latest()->take(10)->get())
@if($unreadNotifications->count())<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $unreadNotifications->count() }}</span>@endif
</button>
<div class="dropdown-menu dropdown-menu-end p-2 shadow-sm" style="width:360px;max-width:calc(100vw - 30px)">
@forelse($unreadNotifications as $notification)
<div class="border-bottom py-2 px-2">
<div class="small">{{ data_get($notification->data,'message') }}</div>
@if(data_get($notification->data,'action')==='request' && auth()->user()->isHelper())
<div class="d-flex gap-2 mt-2">
<form method="POST" action="{{ route('dashboard.contacts.accept',data_get($notification->data,'contact_request_id')) }}">@csrf<button class="btn btn-sm btn-success">Accept</button></form>
<form method="POST" action="{{ route('dashboard.contacts.deny',data_get($notification->data,'contact_request_id')) }}">@csrf<button class="btn btn-sm btn-outline-danger">Deny</button></form>
</div>
@endif
</div>
@empty<div class="small text-muted p-2">No new notifications.</div>@endforelse
<a class="dropdown-item small text-center mt-1" href="{{ route('dashboard.contacts.index') }}">View secure contacts</a>
</div></div>
<div class="dropdown">
<button class="btn btn-light border dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle me-1"></i><span class="d-none d-sm-inline">{{ auth()->user()->name }}</span></button>
<ul class="dropdown-menu dropdown-menu-end shadow-sm">
<li><a class="dropdown-item" href="{{ route('dashboard.profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
<li><a class="dropdown-item" href="{{ route('home') }}"><i class="bi bi-house me-2"></i>Visit website</a></li>
<li><hr class="dropdown-divider"></li>
<li><form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button></form></li>
</ul></div>
</div></div></div>

@if(session('success'))<div class="alert alert-success alert-dismissible fade show mt-3"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}<button class="btn-close" data-bs-dismiss="alert"></button></div>@endif
@if($errors->any())<div class="alert alert-danger mt-3"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<div class="pt-3">@yield('content')</div>
</main>
</div></div>

<div class="offcanvas offcanvas-start mobile-nav" tabindex="-1" id="mobileDashboardMenu" aria-labelledby="mobileDashboardMenuLabel">
<div class="offcanvas-header">
<h5 class="offcanvas-title" id="mobileDashboardMenuLabel"><a class="mobile-brand" href="{{ route('home') }}">Sahayika</a></h5>
<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
</div>
<div class="offcanvas-body">
<div class="text-muted small mb-2">{{ ucfirst(auth()->user()->role) }} panel</div>
<nav class="nav flex-column gap-1">
<a class="nav-link" data-bs-dismiss="offcanvas" href="{{ route('dashboard.index') }}"><i class="bi bi-grid me-2"></i>Dashboard</a>
<a class="nav-link" data-bs-dismiss="offcanvas" href="{{ route('dashboard.profile') }}"><i class="bi bi-person me-2"></i>My Profile</a>
<a class="nav-link" data-bs-dismiss="offcanvas" href="{{ route('dashboard.contacts.index') }}"><i class="bi bi-chat-dots me-2"></i>Secure Contacts</a>
@if(auth()->user()->isCustomer())
<a class="nav-link" href="{{ route('helpers.index') }}"><i class="bi bi-search me-2"></i>Find Helpers</a>
<a class="nav-link" data-bs-dismiss="offcanvas" href="{{ route('dashboard.index') }}#bookings"><i class="bi bi-calendar-check me-2"></i>My Bookings</a>
<a class="nav-link" data-bs-dismiss="offcanvas" href="{{ route('dashboard.index') }}#favorites"><i class="bi bi-heart me-2"></i>Favourites</a>
@elseif(auth()->user()->isHelper())
<a class="nav-link" data-bs-dismiss="offcanvas" href="{{ route('dashboard.index') }}#bookings"><i class="bi bi-calendar-check me-2"></i>Job Requests</a>
<a class="nav-link" data-bs-dismiss="offcanvas" href="{{ route('dashboard.index') }}#services"><i class="bi bi-tools me-2"></i>My Services</a>
<a class="nav-link" data-bs-dismiss="offcanvas" href="{{ route('dashboard.index') }}#remarks"><i class="bi bi-star me-2"></i>Customer Remarks</a>
@else
<a class="nav-link" href="{{ route('dashboard.admin.users') }}"><i class="bi bi-people me-2"></i>Users</a>
<a class="nav-link" href="{{ route('dashboard.admin.services') }}"><i class="bi bi-boxes me-2"></i>Services</a>
<a class="nav-link" href="{{ route('dashboard.admin.bookings') }}"><i class="bi bi-calendar2-week me-2"></i>Bookings</a>
<a class="nav-link" href="{{ route('dashboard.admin.testimonials') }}"><i class="bi bi-chat-quote me-2"></i>Testimonials</a>
<a class="nav-link" href="{{ route('dashboard.admin.settings') }}"><i class="bi bi-sliders me-2"></i>Site Settings</a>
@endif
</nav>
<hr><form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-danger w-100"><i class="bi bi-box-arrow-right me-2"></i>Logout</button></form>
</div></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body></html>