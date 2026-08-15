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

## License
MIT
