<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'phone'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function helperProfile(){ return $this->hasOne(HelperProfile::class); }
    public function customerProfile(){ return $this->hasOne(CustomerProfile::class); }

    public function isHelper(): bool { return $this->role === 'helper'; }
    public function isCustomer(): bool { return $this->role === 'customer'; }
    public function isAdmin(): bool { return $this->role === 'admin'; }
}
