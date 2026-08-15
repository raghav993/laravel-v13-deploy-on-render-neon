# Sahayika – Domestic Helper & Local Worker Marketplace

Sahayika is a Laravel 13 web application that connects customers with verified domestic helpers and local workers through a secure booking platform with dedicated dashboards for Customers, Helpers, and Administrators.

## Features
- Customer, Helper, and Admin dashboards
- Helper search by service and locality
- Booking management
- Favorites
- Secure contact requests
- In-app messaging
- Notifications
- Email support

## Technology Stack
- Laravel 13
- PHP 8.3+
- Blade
- MySQL or SQLite or PostgreSQL
- Composer

## Installation
```bash
git clone https://github.com/raghav993/laravel-v13-deploy-on-render-neon
cd sahayika
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Project Structure
- app/
- database/
- public/
- resources/
- routes/

## Core Modules
- Authentication
- Helper Profiles
- Helper Dashboard
- Customer Dashboard
- Admin Dashboard
- Booking System
- Contact Requests
- Secure Messaging
- Notifications

## Security
- CSRF Protection
- Password Hashing
- Role-Based Authorization

## Local Workers Marketplace

The Local Workers module supports marketplace discovery for tradespeople and on-demand services: keyword, service, city, locality, experience, rate, availability, gender and sorting filters; enriched profile metadata (skills, languages, certifications, verification, rating, salary and working hours); saved workers; recent views; reports; similar-worker suggestions; and a date/time/address booking request with confirmation timeline.

### Routes

- `GET /local-workers` — discovery
- `GET|POST /local-workers/register` — worker profile publishing
- `GET|POST /local-workers/{localWorker}/book` — booking request
- `GET /local-workers/{localWorker}/bookings/{booking}/confirmation` — request confirmation
- `POST|DELETE /local-workers/{localWorker}/save` — authenticated shortlist

### New database tables

`worker_favorites`, `worker_recent_views`, and `worker_reports`. The `local_workers` table gains profile, trust, rating and working-hour fields through a backward-compatible migration.

### User workflow

Search → filter → review profile → save/share → submit booking details → confirmation → booking status updates.

### Screenshot placeholders and roadmap

Add listing, profile, booking, and confirmation screenshots here before release. Future work: reviews, real maps, availability calendar, notifications, and worker comparison.

## License
MIT
