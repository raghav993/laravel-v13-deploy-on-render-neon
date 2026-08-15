<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class WorkerRecentView extends Model { protected $fillable=['user_id','local_worker_id']; public function worker(): BelongsTo { return $this->belongsTo(LocalWorker::class, 'local_worker_id'); } }
