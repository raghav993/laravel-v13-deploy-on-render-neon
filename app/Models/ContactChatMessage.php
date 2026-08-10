<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactChatMessage extends Model
{
    protected $table = 'contact_chat_messages';

    protected $fillable = ['contact_request_id', 'sender_id', 'body'];

    public function request()
    {
        return $this->belongsTo(ContactRequest::class, 'contact_request_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
