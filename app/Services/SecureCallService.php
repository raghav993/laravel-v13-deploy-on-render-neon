<?php

namespace App\Services;

use App\Models\ContactCall;
use App\Models\ContactRequest;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use RuntimeException;

class SecureCallService
{
    public function initiate(ContactRequest $request, User $initiator): ContactCall
    {
        if (!$request->active() || !$request->involves($initiator)) {
            abort(403, 'This contact is not active.');
        }

        if (!$initiator->phone_verified_at) {
            throw new RuntimeException('Your phone number must be verified before calling.');
        }

        $recipient = $this->recipient($request, $initiator);

        if (!$recipient || !$recipient->phone || !$recipient->phone_verified_at) {
            throw new RuntimeException('The other user does not have a verified phone number.');
        }

        $provider = config('calling.provider', 'twilio');

        return match ($provider) {
            'twilio' => $this->twilio($request, $initiator, $recipient),
            default => throw new RuntimeException('Calling provider is not configured.'),
        };
    }

    protected function recipient(ContactRequest $request, User $initiator): ?User
    {
        $request->loadMissing('helperProfile.user');

        return (int) $request->customer_id === (int) $initiator->id
            ? $request->helperProfile?->user
            : $request->customer;
    }

    protected function twilio(ContactRequest $request, User $initiator, User $recipient): ContactCall
    {
        $sid = config('calling.twilio.account_sid');
        $token = config('calling.twilio.auth_token');
        $from = config('calling.twilio.from_number');

        if (!$sid || !$token || !$from) {
            throw new RuntimeException('Calling service is not configured.');
        }

        $call = ContactCall::create([
            'contact_request_id' => $request->id,
            'initiated_by' => $initiator->id,
            'provider' => 'twilio',
            'status' => 'initiating',
        ]);

        $url = URL::signedRoute('contact.voice.connect', [
            'request' => $request->id,
            'initiator' => $initiator->id,
        ]);

        try {
            $response = Http::asForm()
                ->withBasicAuth($sid, $token)
                ->timeout(15)
                ->post("https://api.twilio.com/2010-04-01/Accounts/{$sid}/Calls.json", [
                    'To' => $initiator->phone,
                    'From' => $from,
                    'Url' => $url,
                    'Method' => 'POST',
                ])
                ->throw()
                ->json();

            $call->update([
                'provider_call_id' => $response['sid'] ?? null,
                'status' => 'initiated',
            ]);

            return $call;
        } catch (\Throwable $e) {
            $call->update(['status' => 'failed']);
            throw new RuntimeException('Call could not be initiated.');
        }
    }
}
