# Sahayika Role-wise Dashboard Upgrade

Included:
- Customer dashboard: helper discovery, favourites, booking requests, booking history, remarks/ratings, profile edit.
- Helper dashboard: job requests, accept/reject/complete, availability, service selection, customer remarks, earnings summary, profile/photo.
- Admin dashboard: user management, services, bookings, testimonials, site settings, logo/banner/theme/hero controls.
- New DB tables: bookings, helper_remarks, favorites, testimonials, site_settings.
- Front-end consumes site logo/banner and hero settings.

## Run

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan optimize:clear
php artisan serve
```

If this is a disposable/demo database and you want all demo records rebuilt:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
php artisan optimize:clear
```

Demo admin from the existing project seed:
- Email: admin@sahayika.test
- Password: Demo@12345

The dashboard uses `/dashboard` and redirects automatically by the authenticated user's `role`.

Important:
- The new booking module is a request workflow, not a payment gateway.
- Admin can change booking status.
- Image uploads use Laravel's `public` disk, so `storage:link` is required.
- Before production, add authorization policies, CSRF is already present on forms, rate limiting, verification/KYC, audit logs, and payment integration if required.
