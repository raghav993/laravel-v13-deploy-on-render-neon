<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'phone', 'phone_verified_at'])]
#[Hidden(['password', 'remember_token', 'phone', 'phone_verified_at'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'phone_verified_at' => 'datetime',
        ];
    }

    public function helperProfile(){ return $this->hasOne(HelperProfile::class); }
    public function customerProfile(){ return $this->hasOne(CustomerProfile::class); }

    public function isHelper(): bool { return $this->role === 'helper'; }
    public function isCustomer(): bool { return $this->role === 'customer'; }
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function bookings(){ return $this->hasMany(Booking::class,'customer_id'); }
    public function favorites(){ return $this->hasMany(Favorite::class,'customer_id'); }
    public function testimonials(){ return $this->hasMany(Testimonial::class); }
    public function remarks(){ return $this->hasMany(HelperRemark::class,'customer_id'); }
    public function workerFavorites(){ return $this->hasMany(WorkerFavorite::class); }
    public function recentWorkerViews(){ return $this->hasMany(WorkerRecentView::class); }
    public function localWorkerBookings(){ return $this->hasMany(WorkerBooking::class, 'customer_user_id'); }
}
