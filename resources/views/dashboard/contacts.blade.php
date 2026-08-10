@extends('layouts.dashboard')
@section('heading','Secure Contacts')
@section('content')
<div class="card bg-white p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-1">Customer ↔ Sahayika contacts</h5>
            <p class="text-muted small mb-0">Chat and calls are available only after a request is accepted.</p>
        </div>
    </div>

    @forelse($contacts as $contact)
        @php
            $isCustomer = auth()->user()->isCustomer();
            $otherName = $isCustomer
                ? $contact->helperProfile?->user?->name
                : $contact->customer?->name;
        @endphp
        <div class="border rounded-4 p-3 mb-3">
            <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
                <div>
                    <strong>{{ $otherName ?: 'User' }}</strong>
                    <div class="small text-muted">Request #{{ $contact->id }} · {{ $contact->created_at->format('d M Y, h:i A') }}</div>
                </div>
                <span class="badge text-bg-{{ $contact->status === 'accepted' ? 'success' : ($contact->status === 'pending' ? 'warning' : ($contact->status === 'blocked' ? 'dark' : 'secondary')) }}">
                    {{ ucfirst($contact->status) }}
                </span>
            </div>

            @if($contact->status === 'pending' && auth()->user()->isHelper())
                <div class="d-flex gap-2 mt-3">
                    <form method="POST" action="{{ route('dashboard.contacts.accept',$contact) }}">@csrf
                        <button class="btn btn-sm btn-success"><i class="bi bi-check2 me-1"></i>Accept</button>
                    </form>
                    <form method="POST" action="{{ route('dashboard.contacts.deny',$contact) }}">@csrf
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg me-1"></i>Deny</button>
                    </form>
                </div>
            @elseif($contact->status === 'accepted' && !$contact->blocked_at)
                <div class="mt-3">
                    <a class="btn btn-sm btn-primary" href="{{ route('dashboard.contacts.chat',$contact) }}">
                        <i class="bi bi-chat-dots me-1"></i>Open Chat
                    </a>
                </div>
            @elseif($contact->status === 'pending' && auth()->user()->isCustomer())
                <div class="small text-muted mt-2">Request Sent — waiting for the Sahayika.</div>
            @elseif($contact->status === 'denied' && auth()->user()->isCustomer())
                <div class="small text-muted mt-2">This contact request was declined.</div>
            @elseif($contact->status === 'blocked')
                <div class="small text-muted mt-2">Contact, chat and calls are disabled.</div>
            @endif
        </div>
    @empty
        <div class="text-center text-muted py-5">
            <i class="bi bi-person-lines-fill fs-1 d-block mb-2"></i>
            No contact requests yet.
        </div>
    @endforelse

    {{ $contacts->links() }}
</div>
@endsection
