<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'customer_id',
        'helper_profile_id',
        'status',
        'blocked_by',
        'responded_at',
        'blocked_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'blocked_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function helperProfile()
    {
        return $this->belongsTo(HelperProfile::class);
    }

    public function helper()
    {
        return $this->hasOneThrough(
            User::class,
            HelperProfile::class,
            'id',
            'id',
            'helper_profile_id',
            'user_id'
        );
    }

    public function messages()
    {
        return $this->hasMany(ContactChatMessage::class)->latest();
    }

    public function reports()
    {
        return $this->hasMany(ContactReport::class);
    }

    public function calls()
    {
        return $this->hasMany(ContactCall::class);
    }

    public function involves(User $user): bool
    {
        return (int) $this->customer_id === (int) $user->id
            || (int) $this->helperProfile?->user_id === (int) $user->id;
    }

    public function active(): bool
    {
        return $this->status === 'accepted' && is_null($this->blocked_at);
    }
}
