<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactReport extends Model
{
    protected $fillable = [
        'contact_request_id',
        'reporter_id',
        'reported_user_id',
        'reason',
        'description',
    ];

    public function request()
    {
        return $this->belongsTo(ContactRequest::class, 'contact_request_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }
}
