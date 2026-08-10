<?php

namespace App\Notifications;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ContactRequestNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ContactRequest $contactRequest,
        public string $type = 'request'
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $request = $this->contactRequest->loadMissing('customer:id,name');

        return [
            'type' => 'contact_request',
            'action' => $this->type,
            'contact_request_id' => $request->id,
            'message' => match ($this->type) {
                'accepted' => 'Your contact request was accepted.',
                'denied' => 'Your contact request was declined.',
                default => $request->customer->name . ' wants to contact you.',
            },
        ];
    }
}
