<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactCall extends Model
{
    protected $fillable = [
        'contact_request_id',
        'initiated_by',
        'provider',
        'provider_call_id',
        'status',
    ];

    public function request()
    {
        return $this->belongsTo(ContactRequest::class, 'contact_request_id');
    }

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }
}
