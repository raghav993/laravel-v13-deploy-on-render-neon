@extends('layouts.dashboard')
@section('heading','Secure Chat')
@section('content')
<div class="card bg-white overflow-hidden">
    <div class="p-3 border-bottom d-flex flex-wrap gap-2 justify-content-between align-items-center">
        @php
            $other = auth()->id() === $contactRequest->customer_id
                ? $contactRequest->helperProfile?->user
                : $contactRequest->customer;
        @endphp
        <div>
            <strong><i class="bi bi-shield-lock me-1 text-brand"></i>{{ $other?->name ?: 'Contact' }}</strong>
            <div class="small text-muted">Private 1-to-1 contact</div>
        </div>
        <div class="d-flex gap-2">
            <form method="POST" action="{{ route('dashboard.contacts.call',$contactRequest) }}">@csrf
                <button class="btn btn-sm btn-success" title="Secure call">
                    <i class="bi bi-telephone me-1"></i>Call
                </button>
            </form>
            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#reportModal">
                <i class="bi bi-flag me-1"></i>Report
            </button>
            <form method="POST" action="{{ route('dashboard.contacts.block',$contactRequest) }}" onsubmit="return confirm('Block this contact? Chat and calls will stop immediately.')">@csrf
                <button class="btn btn-sm btn-outline-dark"><i class="bi bi-slash-circle me-1"></i>Block</button>
            </form>
        </div>
    </div>

    <div id="chatMessages" class="p-3" style="height:55vh;min-height:360px;overflow-y:auto;background:#f8f5ee">
        @foreach($messages as $message)
            <div class="d-flex {{ $message->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }} mb-2" data-message-id="{{ $message->id }}">
                <div class="px-3 py-2 rounded-4 {{ $message->sender_id === auth()->id() ? 'bg-brand text-white' : 'bg-white border' }}" style="max-width:78%">
                    <div class="small">{{ $message->body }}</div>
                    <div class="small opacity-75 mt-1">{{ $message->created_at->format('H:i') }}</div>
                </div>
            </div>
        @endforeach
    </div>

    <form id="chatForm" class="p-3 border-top">
        @csrf
        <div class="input-group">
            <input id="chatInput" class="form-control" maxlength="2000" placeholder="Type a message..." autocomplete="off" required>
            <button id="sendButton" class="btn btn-primary" type="submit"><i class="bi bi-send me-1"></i>Send</button>
        </div>
        <div id="chatError" class="small text-danger mt-2"></div>
    </form>
</div>

<div class="modal fade" id="reportModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('dashboard.contacts.report',$contactRequest) }}">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Report contact</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <label class="form-label">Reason</label>
                <select name="reason" class="form-select mb-3" required>
                    <option value="spam">Spam</option>
                    <option value="harassment">Harassment</option>
                    <option value="inappropriate_content">Inappropriate content</option>
                    <option value="scam_or_fraud">Scam or fraud</option>
                    <option value="safety_concern">Safety concern</option>
                    <option value="other">Other</option>
                </select>
                <label class="form-label">Description <span class="text-muted">(optional)</span></label>
                <textarea name="description" class="form-control" maxlength="2000" rows="4" placeholder="Add useful details"></textarea>
            </div>
            <div class="modal-footer"><button class="btn btn-danger">Submit report</button></div>
        </form>
    </div>
</div>

<script>
(() => {
    const box = document.getElementById('chatMessages');
    const form = document.getElementById('chatForm');
    const input = document.getElementById('chatInput');
    const error = document.getElementById('chatError');
    const send = document.getElementById('sendButton');
    let lastId = Number(document.querySelector('[data-message-id]:last-of-type')?.dataset.messageId || 0);

    const render = (m) => {
        const mine = Number(m.sender_id) === {{ auth()->id() }};
        const row = document.createElement('div');
        row.className = 'd-flex ' + (mine ? 'justify-content-end' : 'justify-content-start') + ' mb-2';
        row.dataset.messageId = m.id;

        const bubble = document.createElement('div');
        bubble.className = 'px-3 py-2 rounded-4 ' + (mine ? 'bg-brand text-white' : 'bg-white border');
        bubble.style.maxWidth = '78%';

        const body = document.createElement('div');
        body.className = 'small';
        body.textContent = m.body;

        const time = document.createElement('div');
        time.className = 'small opacity-75 mt-1';
        time.textContent = m.created_at;

        bubble.append(body, time);
        row.appendChild(bubble);
        box.appendChild(row);
        box.scrollTop = box.scrollHeight;
    };

    async function poll() {
        try {
            const response = await fetch('{{ route('dashboard.contacts.messages',$contactRequest) }}?after=' + lastId, {
                headers: {'Accept':'application/json', 'X-Requested-With':'XMLHttpRequest'}
            });
            if (!response.ok) return;
            const data = await response.json();
            data.messages.forEach(m => {
                if (Number(m.id) > lastId) lastId = Number(m.id);
                if (!document.querySelector('[data-message-id="' + m.id + '"]')) render(m);
            });
        } catch (_) {}
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        error.textContent = '';
        const body = input.value.trim();
        if (!body) return;

        send.disabled = true;
        try {
            const response = await fetch('{{ route('dashboard.contacts.messages.send',$contactRequest) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('#chatForm input[name="_token"]').value
                },
                body: JSON.stringify({body})
            });
            const data = await response.json();
            if (!response.ok) throw new Error(data.message || 'Message could not be sent.');
            render(data.message);
            lastId = Number(data.message.id);
            input.value = '';
        } catch (e) {
            error.textContent = e.message;
        } finally {
            send.disabled = false;
            input.focus();
        }
    });

    box.scrollTop = box.scrollHeight;
    setInterval(poll, 4000);
})();
</script>
@endsection
