<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocalWorker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'phone', 'category', 'skills', 'bio',
        'city', 'area', 'experience_years', 'service_type',
        'availability_status', 'hourly_rate', 'avatar_color', 'gender', 'languages', 'certifications', 'expected_salary', 'working_hours', 'verification_status', 'is_verified', 'profile_completion', 'rating', 'ratings_count',
    ];

    protected $casts = [
        'skills' => 'array',
        'experience_years' => 'integer',
        'hourly_rate' => 'decimal:2', 'expected_salary' => 'decimal:2', 'languages' => 'array', 'certifications' => 'array', 'is_verified' => 'boolean', 'rating' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(WorkerBooking::class);
    }
    public function favorites(): HasMany { return $this->hasMany(WorkerFavorite::class); }
    public function recentViews(): HasMany { return $this->hasMany(WorkerRecentView::class); }
    public function getProfileCompletionAttribute($value): int { $fields=['name','phone','category','city','area','bio','skills','languages','working_hours','hourly_rate']; return (int) round(collect($fields)->filter(fn($field)=>filled($this->getAttribute($field)))->count()/count($fields)*100); }

    public function getInitialsAttribute(): string
    {
        return collect(preg_split('/\s+/', trim($this->name)))
            ->filter()
            ->take(2)
            ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
            ->implode('');
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'carpenter' => 'Carpenter',
            'mason' => 'Mistri / Mason',
            'iron' => 'Ironing & Laundry',
            'massage' => 'Massage',
            'barber' => 'Barber / Nai',
            'electrician' => 'Electrician',
            'plumber' => 'Plumber',
            'painter' => 'Painter',
            'cleaning' => 'Cleaning',
            'cook' => 'Cook',
            default => ucfirst(str_replace('_', ' ', $this->category)),
        };
    }

    public function getAvailabilityLabelAttribute(): string
    {
        return match ($this->availability_status) {
            'available' => 'Available today',
            'busy' => 'Busy',
            default => 'Unavailable',
        };
    }
}
