<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:30px;">
    <div style="max-width:650px;margin:auto;background:#ffffff;padding:30px;border-radius:12px;">
        <h2 style="margin-top:0;">
            New Contact Message
        </h2>
        <p>
            A new message has been received through the Sahayika website.
        </p>
        <hr>
        <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
        <p>
            <strong>Email:</strong>
            {{ $contactMessage->email }}
        </p>
        @if($contactMessage->phone)
        <p>
            <strong>Phone:</strong>
            {{ $contactMessage->phone }}
        </p>
        @endif
        <p>
            <strong>Subject:</strong>
            {{ $contactMessage->subject }}
        </p>
        <p><strong>Message:</strong></p>
        <div style="
        background:#f8f8f8;
        padding:15px;
        border-radius:8px;
        white-space:pre-line;
    ">
            {{ $contactMessage->message }}
        </div>
        <hr>
        <p style="color:#777;font-size:13px;">
            Message ID: #{{ $contactMessage->id }}
        </p>
    </div>
</body>
</html>