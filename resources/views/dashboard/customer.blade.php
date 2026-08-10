@extends('layouts.dashboard')
@section('heading','Welcome back, '.auth()->user()->name.' 👋')
@section('content')
<div class="row g-3 mb-4">
    @php($stats=[
    ['Bookings',$bookings->count(),'bi-calendar-check'],
    ['Saved Helpers',$favorites->count(),'bi-heart'],
    ['Pending Requests',$bookings->where('status','pending')->count(),'bi-hourglass-split'],
    ['Completed',$bookings->where('status','completed')->count(),'bi-check2-circle']
    ])
    @foreach($stats as $s)
    <div class="col-6 col-xl-3">
        <div class="card stat p-3 bg-white h-100">
            <i class="bi {{ $s[2] }} fs-4 text-brand"></i>
            <div class="text-muted small mt-2">{{ $s[0] }}</div>
            <div class="fs-3 fw-bold">{{ $s[1] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="card p-4 mb-4 bg-white">
    <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-1">Find trusted help</h5>
            <p class="text-muted small mb-0">Browse helpers for cleaning, cooking, child care and elder care.</p>
        </div>
        <a class="btn btn-warning" href="{{ route('helpers.index') }}"><i class="bi bi-search me-1"></i>Find Helpers</a>
    </div>
    <div class="row g-3">
        @forelse($recommended as $h)
        <div class="col-md-6 col-xl-4">
            <div class="border rounded-4 p-3 h-100 d-flex flex-column">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-brand text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width:52px;height:52px">{{ collect(explode(' ',$h->user->name))->map(fn($x)=>mb_substr($x,0,1))->take(2)->implode('') }}</div>
                    <div class="min-w-0"><b class="d-block text-truncate">{{ $h->user->name }}</b>
                        <div class="small text-muted text-truncate"><i class="bi bi-geo-alt"></i> {{ $h->locality?->name ?: 'Location not specified' }}</div>
                    </div>
                </div>
                <div class="small mt-3">{{ $h->experience_years ?: 0 }} yrs experience · {{ $h->work_type==='full_time'?'Full-time':'Part-time' }}</div>
                <div class="d-flex flex-wrap gap-1 mt-2">@foreach($h->services->take(3) as $s)<span class="badge text-bg-light">{{ $s->name_hi ?: $s->name }}</span>@endforeach</div>
                <div class="d-flex gap-2 mt-auto pt-3">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('helpers.show',$h) }}">View</a>
                    <form method="POST" action="{{ route('dashboard.helper.favorite',$h) }}">@csrf<button class="btn btn-sm btn-outline-danger" title="Save helper"><i class="bi bi-heart"></i></button></form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center text-muted py-4">No helpers available right now.</div>
        </div>
        @endforelse
    </div>
</div>

<div class="card bg-white p-4 mb-4" id="contacts">
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-1">Secure contacts</h5>
            <p class="text-muted small mb-0">Private chat and secure calling become available after acceptance.</p>
        </div>
        <a class="btn btn-sm btn-outline-primary" href="{{ route('dashboard.contacts.index') }}">View all</a>
    </div>
    @forelse($contactRequests as $cr)
    @php($helperName = $cr->helperProfile?->user?->name ?: 'Sahayika')
    <div class="border rounded-4 p-3 mb-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div><strong>{{ $helperName }}</strong>
            <div class="small text-muted">{{ $cr->created_at->format('d M Y') }}</div>
        </div>
        <div>
            @if($cr->status==='pending')<span class="badge text-bg-warning">Request Sent</span>
            @elseif($cr->status==='accepted' && !$cr->blocked_at)<a class="btn btn-sm btn-primary" href="{{ route('dashboard.contacts.chat',$cr) }}">Chat / Call</a>
            @elseif($cr->status==='denied')<span class="badge text-bg-secondary">Declined</span>
            @else<span class="badge text-bg-dark">Blocked</span>@endif
        </div>
    </div>
    @empty<p class="text-muted mb-0">No contact requests yet.</p>
    @endforelse
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="card bg-white p-4" id="bookings">
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
        <div><h5 class="mb-1">Recent bookings</h5><p class="text-muted small mb-0">Track requests and review completed services.</p></div>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>Helper</th><th>Service</th><th>Date</th><th>Status</th><th class="text-end">Review</th></tr></thead>
            <tbody>
            @forelse($bookings as $b)
                <tr>
                    <td>{{ $b->helper->user->name }}</td>
                    <td>{{ $b->service?->name ?: 'General help' }}</td>
                    <td>{{ $b->booking_date?->format('d M Y') ?: 'Flexible' }}</td>
                    <td><span class="badge text-bg-{{ $b->status==='completed'?'success':($b->status==='rejected'?'danger':'warning') }}">{{ ucfirst($b->status) }}</span></td>
                    <td class="text-end">
                        @if($b->status==='completed')
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $b->id }}"><i class="bi bi-star me-1"></i>Add review</button>
                        @else <span class="text-muted small">—</span> @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No bookings yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Bootstrap modals MUST remain outside the table/tbody for reliable mobile rendering. --}}
@foreach($bookings->where('status','completed') as $b)
<div class="modal fade" id="reviewModal{{ $b->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="{{ route('dashboard.helper.remark',$b->helper) }}">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $b->id }}">
            <div class="modal-header">
                <div><h5 class="modal-title mb-1">Review {{ $b->helper->user->name }}</h5><div class="small text-muted">Share your experience</div></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label fw-semibold">Rating</label>
                <div class="d-flex gap-2 mb-3">
                    @for($i=1;$i<=5;$i++)
                    <label class="btn btn-outline-warning flex-fill"><input class="visually-hidden" type="radio" name="rating" value="{{ $i }}" {{ $i===5?'checked':'' }}><span class="fs-5">{{ $i }} ★</span></label>
                    @endfor
                </div>
                <label class="form-label fw-semibold">Your review</label>
                <textarea name="remark" class="form-control" rows="4" maxlength="1000" required placeholder="What did you like about the service?"></textarea>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary"><i class="bi bi-send me-1"></i>Submit review</button></div>
        </form>
    </div>
</div>
@endforeach

    <div class="col-xl-4">
        <div class="card bg-white p-4 h-100" id="favorites">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Saved Helpers</h5><a class="small text-decoration-none" href="{{ route('helpers.index') }}">Find more</a>
            </div>
            @forelse($favorites as $fav)
            @php($fh=$fav->helper)
            <div class="d-flex align-items-center gap-2 py-2 border-bottom">
                <div class="rounded-circle bg-brand text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width:40px;height:40px">{{ mb_substr($fh->user->name,0,1) }}</div>
                <div class="min-w-0 flex-grow-1">
                    <div class="fw-semibold text-truncate">{{ $fh->user->name }}</div>
                    <div class="small text-muted">{{ $fh->locality?->name ?: 'Location unavailable' }}</div>
                </div><a class="btn btn-sm btn-outline-secondary" href="{{ route('helpers.show',$fh) }}">View</a>
            </div>
            @empty<p class="text-muted small mb-0">No saved helpers yet.</p>@endforelse
        </div>
    </div>
</div>
@endsection