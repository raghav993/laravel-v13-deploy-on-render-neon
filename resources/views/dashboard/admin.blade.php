@extends('layouts.dashboard')
@section('heading','Admin Overview')
@section('content')
<div class="row g-3 mb-4">
    @foreach([['Total Users',$stats['users'],'bi-people'],['Customers',$stats['customers'],'bi-person'],['Helpers',$stats['helpers'],'bi-person-workspace'],['Pending Bookings',$stats['pending_bookings'],'bi-calendar2-week'],['Services',$stats['services'],'bi-boxes'],['Pending Testimonials',$stats['testimonials'],'bi-chat-quote']] as $s)<div class="col-6 col-xl-2">
        <div class="card bg-white p-3 h-100"><i class="bi {{ $s[2] }} fs-4 text-brand"></i><small class="text-muted mt-2">{{ $s[0] }}</small><strong class="fs-4">{{ $s[1] }}</strong></div>
    </div>@endforeach
</div>
<div class="row g-4">
    <div class="col-xl-8">
        <div class="card bg-white p-4">
            <div class="d-flex justify-content-between">
                <h5>Recent bookings</h5><a href="{{ route('dashboard.admin.bookings') }}" class="btn btn-sm btn-outline-primary">View all</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Helper</th>
                            <th>Service</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>@foreach($recentBookings as $b)<tr>
                            <td>{{ $b->customer->name }}</td>
                            <td>{{ $b->helper->user->name }}</td>
                            <td>{{ $b->service?->name }}</td>
                            <td><span class="badge text-bg-warning">{{ ucfirst($b->status) }}</span></td>
                        </tr>@endforeach</tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card bg-white p-4">
            <h5>Quick actions</h5>
            <div class="d-grid gap-2 mt-3"><a class="btn btn-primary" href="{{ route('dashboard.admin.users') }}"><i class="bi bi-people me-2"></i>Manage Users</a><a class="btn btn-outline-primary" href="{{ route('dashboard.admin.services') }}"><i class="bi bi-boxes me-2"></i>Manage Services</a><a class="btn btn-outline-primary" href="{{ route('dashboard.admin.testimonials') }}"><i class="bi bi-chat-quote me-2"></i>Testimonials</a><a class="btn btn-outline-primary" href="{{ route('dashboard.admin.settings') }}"><i class="bi bi-sliders me-2"></i>Site Settings</a></div>
            <hr>
            <h6>Latest users</h6>@foreach($recentUsers as $u)<div class="d-flex justify-content-between py-2 border-bottom"><span>{{ $u->name }}</span><span class="badge text-bg-light">{{ $u->role }}</span></div>@endforeach
        </div>
    </div>
</div>
@endsection