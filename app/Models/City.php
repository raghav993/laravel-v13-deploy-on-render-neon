<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['state_id','name','slug'];
    public function state(){ return $this->belongsTo(State::class); }
    public function localities(){ return $this->hasMany(Locality::class); }
}
