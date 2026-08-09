<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Favorite extends Model {
    protected $fillable=['customer_id','helper_profile_id'];
    public function customer(){return $this->belongsTo(User::class,'customer_id');}
    public function helper(){return $this->belongsTo(HelperProfile::class,'helper_profile_id');}
}
