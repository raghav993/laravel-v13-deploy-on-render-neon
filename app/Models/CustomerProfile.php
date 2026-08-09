<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerProfile extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id','locality_id','address_line','pincode'];
    public function user(){ return $this->belongsTo(User::class); }
    public function locality(){ return $this->belongsTo(Locality::class); }
}
