<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelperSearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
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
    Route::patch('/admin/testimonials/{testimonial}/approve', [DashboardController::class, 'testimonialApprove'])->name('admin.testimonials.approve');
    Route::delete('/admin/testimonials/{testimonial}', [DashboardController::class, 'testimonialDelete'])->name('admin.testimonials.delete');
    Route::get('/admin/settings', [DashboardController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [DashboardController::class, 'settingsSave'])->name('admin.settings.save');
    Route::get('/admin/bookings', [DashboardController::class, 'bookings'])->name('admin.bookings');
});
