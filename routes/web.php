<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelperSearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SecureContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/careers', [PageController::class, 'careers'])->name('careers');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/help', [PageController::class, 'help'])->name('help');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/helpers', [HelperSearchController::class, 'index'])->name('helpers.index');
Route::get('/helpers/{helperProfile}', [HelperSearchController::class, 'show'])->name('helpers.show');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Secure server-to-server voice webhook. Signed URL only; no browser phone data is returned.
Route::post('/contact/voice/{contactRequest}/connect', [SecureContactController::class, 'voiceConnect'])
    ->middleware('signed')
    ->name('contact.voice.connect');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/photo', [DashboardController::class, 'photo'])->name('profile.photo');

    Route::post('/helpers/{helper}/book', [DashboardController::class, 'book'])->name('helper.book');
    Route::post('/helpers/{helper}/favorite', [DashboardController::class, 'favorite'])->name('helper.favorite');
    Route::delete('/helpers/{helper}/favorite', [DashboardController::class, 'unfavorite'])->name('helper.unfavorite');
    Route::post('/helpers/{helper}/remark', [DashboardController::class, 'remark'])->name('helper.remark');

    // Secure customer ↔ Sahayika contact system
    Route::get('/contacts', [SecureContactController::class, 'contacts'])->name('contacts.index');
    Route::post('/helpers/{helper}/contact', [SecureContactController::class, 'request'])->name('helper.contact');
    Route::post('/contacts/{contactRequest}/accept', [SecureContactController::class, 'accept'])->name('contacts.accept');
    Route::post('/contacts/{contactRequest}/deny', [SecureContactController::class, 'deny'])->name('contacts.deny');
    Route::get('/contacts/{contactRequest}/chat', [SecureContactController::class, 'chat'])->name('contacts.chat');
    Route::get('/contacts/{contactRequest}/messages', [SecureContactController::class, 'messages'])->name('contacts.messages');
    Route::post('/contacts/{contactRequest}/messages', [SecureContactController::class, 'sendMessage'])->name('contacts.messages.send');
    Route::post('/contacts/{contactRequest}/block', [SecureContactController::class, 'block'])->name('contacts.block');
    Route::post('/contacts/{contactRequest}/report', [SecureContactController::class, 'report'])->name('contacts.report');
    Route::post('/contacts/{contactRequest}/call', [SecureContactController::class, 'call'])->name('contacts.call');


    Route::post('/bookings/{booking}/status', [DashboardController::class, 'bookingStatus'])->name('booking.status');

    Route::post('/helper/services', [DashboardController::class, 'helperServices'])->name('helper.services');
    Route::post('/helper/availability', [DashboardController::class, 'availability'])->name('helper.availability');

    Route::get('/admin/users', [DashboardController::class, 'users'])->name('admin.users');
    Route::put('/admin/users/{user}', [DashboardController::class, 'userUpdate'])->name('admin.users.update');
    Route::get('/admin/services', [DashboardController::class, 'services'])->name('admin.services');
    Route::post('/admin/services', [DashboardController::class, 'serviceStore'])->name('admin.services.store');
    Route::put('/admin/services/{service}', [DashboardController::class, 'serviceUpdate'])->name('admin.services.update');
    Route::delete('/admin/services/{service}', [DashboardController::class, 'serviceDelete'])->name('admin.services.delete');
    Route::get('/admin/testimonials', [DashboardController::class, 'testimonials'])->name('admin.testimonials');
    Route::post('/admin/testimonials', [DashboardController::class, 'testimonialStore'])->name('admin.testimonials.store');
    Route::put('/admin/testimonials/{testimonial}/approve', [DashboardController::class, 'testimonialApprove'])->name('admin.testimonials.approve');
    Route::delete('/admin/testimonials/{testimonial}', [DashboardController::class, 'testimonialDelete'])->name('admin.testimonials.delete');
    Route::get('/admin/settings', [DashboardController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [DashboardController::class, 'settingsSave'])->name('admin.settings.save');
    Route::get('/admin/bookings', [DashboardController::class, 'bookings'])->name('admin.bookings');
});
