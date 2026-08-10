<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkerBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_worker_id', 'customer_user_id', 'customer_name', 'customer_phone',
        'service_date', 'service_time', 'address', 'notes', 'status',
    ];

    protected $casts = [
        'service_date' => 'date',
    ];

    public function worker(): BelongsTo
    {
        return $this->belongsTo(LocalWorker::class, 'local_worker_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_user_id');
    }
}
