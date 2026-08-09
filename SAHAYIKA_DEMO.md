# Sahayika — Indore development dataset

This project extension adds a normalized domestic/family-support marketplace schema and fictional Indore demo data.

## Database

Existing Laravel `users`, `password_reset_tokens`, `sessions`, cache and jobs tables are reused.

The marketplace migration adds:

- `users.role`: `customer`, `helper`, `admin`
- `users.phone`
- `states`
- `cities`
- `localities`
- `service_categories`
- `services`
- `helper_profiles`
- `customer_profiles`
- `helper_service`
- `helper_availabilities`

The schema intentionally does not collect Aadhaar, PAN, bank details, identity documents, or other unnecessary sensitive information.

## Demo data

Running the normal Laravel seeder creates:

- 1 admin
- 12 customer/household accounts
- 40 helper accounts
- 5 service categories
- 17 services
- 23 Indore localities
- Multiple services and schedules per helper

All people, addresses, emails and phone values are fictional development data. Demo addresses are explicitly labelled as fictional.

### Demo credentials

Password for all seeded accounts:

`Demo@12345`

Admin:
`admin@sahayika.test`

Customer:
`demo.customer01@sahayika.test`

Helper:
`demo.helper01@sahayika.test`

These credentials are for local development/testing only.

## Initialize

```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

Use:

- `/register` for Customer or Helper registration
- `/login` for Customer, Helper or Admin login

## Search-ready relationships

Examples supported by the schema:

```php
HelperProfile::query()
    ->active()
    ->partTime()
    ->where('locality_id', $localityId)
    ->whereBetween('expected_salary', [3000, 8000])
    ->whereHas('services', fn ($q) => $q->where('slug', 'sweeping-mopping'))
    ->whereHas('availabilities', fn ($q) =>
        $q->where('day_of_week', 1)
          ->where('start_time', '<=', '08:00:00')
          ->where('end_time', '>=', '12:00:00')
    )
    ->get();
```

## Image handling

No fake external profile-photo URLs are seeded. `helper_profiles.profile_photo` is nullable so a later upload/local-placeholder implementation can be added without storing broken external URLs.
