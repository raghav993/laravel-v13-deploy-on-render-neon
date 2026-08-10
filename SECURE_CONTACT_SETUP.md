# Secure Customer–Sahayika Contact System

Implemented without replacing the existing authentication, marketplace schema, booking flow, or public contact form.

## Database

Run:

```bash
php artisan migrate
```

New tables:
- `contact_requests`
- `contact_chat_messages`
- `contact_reports`
- `contact_calls`
- `notifications`

`users.phone_verified_at` is also added.

## Secure calling

The call flow uses a backend-only Twilio integration. The browser never receives either user's phone number.

Add these environment variables:

```env
CALL_PROVIDER=twilio
TWILIO_ACCOUNT_SID=
TWILIO_AUTH_TOKEN=
TWILIO_FROM_NUMBER=
```

`TWILIO_FROM_NUMBER` must be a Twilio number capable of making voice calls.

Before a call can be placed, both users' phone numbers must have `phone_verified_at` set. Existing admins can mark a phone as verified from Dashboard → User Management. Changing a verified phone number automatically clears its verification.

The Twilio voice webhook is a signed Laravel URL and returns the recipient phone number only to Twilio's server-to-server request, never to the browser.

## Contact state

- `pending` → `accepted`
- `pending` → `denied`
- `accepted` → `blocked`

A unique customer/helper pair prevents duplicate pending requests. A denied request can be submitted again; a blocked pair cannot.

## Authorization

All request, chat, message, block, report and call actions verify the authenticated participant server-side. Chat/message/call actions require an accepted, non-blocked contact.

The public helper profile no longer selects or exposes the user's phone number. The `User` model also hides phone fields during serialization.
