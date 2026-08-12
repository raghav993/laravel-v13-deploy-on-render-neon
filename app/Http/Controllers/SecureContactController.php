<?php

namespace App\Http\Controllers;

use App\Models\ContactChatMessage;
use App\Models\ContactReport;
use App\Models\ContactRequest;
use App\Models\HelperProfile;
use App\Notifications\ContactRequestNotification;
use App\Services\SecureCallService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use RuntimeException;

class SecureContactController extends Controller
{
    private function user()
    {
        return auth()->user();
    }

    private function authorizeParticipant(ContactRequest $contactRequest): void
    {
        $contactRequest->loadMissing('helperProfile');

        abort_unless(
            $contactRequest->customer_id === $this->user()->id
            || $contactRequest->helperProfile?->user_id === $this->user()->id,
            403
        );
    }

    private function authorizeCustomer(): void
    {
        abort_unless($this->user()->isCustomer(), 403);
    }

    public function request(HelperProfile $helper)
    {
        $this->authorizeCustomer();

        abort_unless($helper->profile_status === 'active', 404);
        abort_unless($helper->user_id !== $this->user()->id, 403);

        $existing = ContactRequest::where('customer_id', $this->user()->id)
            ->where('helper_profile_id', $helper->id)
            ->first();

        if ($existing?->status === 'blocked') {
            return back()->withErrors(['contact' => 'आप इस Sahayika को contact नहीं कर सकते। संभव है कि contact restriction लागू हो।']);
        }

        if ($existing?->status === 'pending') {
            return back()->with('success', 'आपका contact request पहले से pending है। कृपया response का इंतजार करें।');
        }

        if ($existing?->status === 'accepted' && !$existing->blocked_at) {
            return back()->with('success', 'यह contact पहले से active है। आप secure chat का उपयोग कर सकते हैं।');
        }

        $contactRequest = DB::transaction(function () use ($existing, $helper) {
            if ($existing) {
                $existing->update([
                    'status' => 'pending',
                    'blocked_by' => null,
                    'responded_at' => null,
                    'blocked_at' => null,
                ]);
                return $existing->fresh();
            }

            return ContactRequest::create([
                'customer_id' => $this->user()->id,
                'helper_profile_id' => $helper->id,
                'status' => 'pending',
            ]);
        });

        $helper->user->notify(new ContactRequestNotification($contactRequest, 'request'));

        return back()->with('success', 'Contact request सफलतापूर्वक भेज दी गई है। Sahayika के response का इंतजार करें।');
    }

    public function accept(ContactRequest $contactRequest)
    {
        abort_unless($this->user()->isHelper(), 403);
        $contactRequest->loadMissing('helperProfile.user', 'customer');

        abort_unless($contactRequest->helperProfile?->user_id === $this->user()->id, 403);
        abort_unless($contactRequest->status === 'pending', 409);

        $contactRequest->update([
            'status' => 'accepted',
            'responded_at' => now(),
        ]);

        $contactRequest->customer->notify(
            new ContactRequestNotification($contactRequest, 'accepted')
        );

        $this->markNotificationRead($contactRequest->id, 'request');

        return back()->with('success', 'Contact request स्वीकार कर ली गई है। अब secure chat उपलब्ध है।');
    }

    public function deny(ContactRequest $contactRequest)
    {
        abort_unless($this->user()->isHelper(), 403);
        $contactRequest->loadMissing('helperProfile.user', 'customer');

        abort_unless($contactRequest->helperProfile?->user_id === $this->user()->id, 403);
        abort_unless($contactRequest->status === 'pending', 409);

        $contactRequest->update([
            'status' => 'denied',
            'responded_at' => now(),
        ]);

        $contactRequest->customer->notify(
            new ContactRequestNotification($contactRequest, 'denied')
        );

        $this->markNotificationRead($contactRequest->id, 'request');

        return back()->with('success', 'Contact request decline कर दी गई है।');
    }

    public function chat(ContactRequest $contactRequest)
    {
        $this->authorizeParticipant($contactRequest);
        abort_unless($contactRequest->active(), 403);

        $contactRequest->loadMissing('customer:id,name', 'helperProfile.user:id,name');
        $messages = $contactRequest->messages()
            ->with('sender:id,name')
            ->latest('id')
            ->take(100)
            ->get()
            ->reverse()
            ->values();

        return view('dashboard.contact-chat', compact('contactRequest', 'messages'));
    }

    public function messages(ContactRequest $contactRequest)
    {
        $this->authorizeParticipant($contactRequest);
        abort_unless($contactRequest->active(), 403);

        $after = request()->integer('after', 0);

        $messages = ContactChatMessage::query()
            ->where('contact_request_id', $contactRequest->id)
            ->when($after > 0, fn ($q) => $q->where('id', '>', $after))
            ->with('sender:id,name')
            ->orderBy('id')
            ->limit(100)
            ->get()
            ->map(fn ($message) => [
                'id' => $message->id,
                'body' => $message->body,
                'sender_id' => $message->sender_id,
                'sender_name' => $message->sender->name,
                'created_at' => $message->created_at->format('H:i'),
            ]);

        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request, ContactRequest $contactRequest)
    {
        $this->authorizeParticipant($contactRequest);
        abort_unless($contactRequest->active(), 403);

        $data = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $message = ContactChatMessage::create([
            'contact_request_id' => $contactRequest->id,
            'sender_id' => $this->user()->id,
            'body' => trim($data['body']),
        ]);

        return response()->json([
            'message' => [
                'id' => $message->id,
                'body' => $message->body,
                'sender_id' => $message->sender_id,
                'sender_name' => $this->user()->name,
                'created_at' => $message->created_at->format('H:i'),
            ],
        ], 201);
    }

    public function block(ContactRequest $contactRequest)
    {
        $this->authorizeParticipant($contactRequest);
        abort_unless($contactRequest->status === 'accepted', 403);

        $contactRequest->update([
            'status' => 'blocked',
            'blocked_by' => $this->user()->id,
            'blocked_at' => now(),
        ]);

        return redirect()->route('dashboard.contacts.index')
            ->with('success', 'यह contact block कर दिया गया है। अब इस contact के माध्यम से communication बंद है।');
    }

    public function report(Request $request, ContactRequest $contactRequest)
    {
        $this->authorizeParticipant($contactRequest);

        $data = $request->validate([
            'reason' => ['required', Rule::in([
                'spam',
                'harassment',
                'inappropriate_content',
                'scam_or_fraud',
                'safety_concern',
                'other',
            ])],
            'description' => ['nullable', 'string', 'max:2000'],
        ]);

        $reportedUserId = (int) $contactRequest->customer_id === (int) $this->user()->id
            ? (int) $contactRequest->helperProfile()->value('user_id')
            : (int) $contactRequest->customer_id;

        ContactReport::firstOrCreate(
            [
                'contact_request_id' => $contactRequest->id,
                'reporter_id' => $this->user()->id,
            ],
            $data + ['reported_user_id' => $reportedUserId]
        );

        return back()->with('success', 'Report सुरक्षित रूप से submit हो गई है। हमारी team इसे review करेगी।');
    }

    public function call(ContactRequest $contactRequest, SecureCallService $callService)
    {
        $this->authorizeParticipant($contactRequest);
        abort_unless($contactRequest->active(), 403);

        try {
            $callService->initiate($contactRequest, $this->user());
        } catch (RuntimeException $e) {
            return back()->withErrors(['call' => $e->getMessage()]);
        }

        return back()->with('success', 'Secure call request शुरू हो गई है। आपका verified phone सुरक्षित रूप से connect किया जाएगा.');
    }

    public function contacts()
    {
        $u = $this->user();

        if ($u->isCustomer()) {
            $contacts = ContactRequest::where('customer_id', $u->id)
                ->with('helperProfile.user:id,name')
                ->latest()
                ->paginate(12);
        } elseif ($u->isHelper()) {
            $contacts = ContactRequest::whereHas(
                'helperProfile',
                fn ($q) => $q->where('user_id', $u->id)
            )->with('customer:id,name')->latest()->paginate(12);
        } else {
            abort(403);
        }

        return view('dashboard.contacts', compact('contacts'));
    }

    private function markNotificationRead(int $requestId, string $action): void
    {
        $this->user()->unreadNotifications
            ->filter(fn ($notification) =>
                data_get($notification->data, 'contact_request_id') == $requestId
                && data_get($notification->data, 'action') === $action
            )
            ->each->markAsRead();
    }

    /**
     * Twilio's signed webhook. No phone number is returned to the browser.
     */
    public function voiceConnect(ContactRequest $contactRequest)
    {
        $initiatorId = request()->integer('initiator');
        abort_unless($initiatorId > 0, 403);

        $initiator = \App\Models\User::findOrFail($initiatorId);
        $this->authorizeTwilioParticipant($contactRequest, $initiator);

        $recipient = $contactRequest->customer_id === $initiator->id
            ? $contactRequest->helperProfile()->with('user')->first()?->user
            : $contactRequest->customer;

        abort_unless($recipient?->phone_verified_at && $recipient?->phone, 403);

        $twiml = '<?xml version="1.0" encoding="UTF-8"?>'
            . '<Response><Say voice="alice">Connecting your secure Sahayika call.</Say>'
            . '<Dial>' . e($recipient->phone) . '</Dial></Response>';

        return Response::make($twiml, 200, ['Content-Type' => 'text/xml']);
    }

    private function authorizeTwilioParticipant(ContactRequest $contactRequest, \App\Models\User $initiator): void
    {
        abort_unless($contactRequest->active(), 403);
        abort_unless($contactRequest->involves($initiator), 403);
        abort_unless($initiator->phone_verified_at && $initiator->phone, 403);
    }
}
