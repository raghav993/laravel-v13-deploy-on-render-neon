<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HelperRemark extends Model {
    protected $fillable=['customer_id','helper_profile_id','booking_id','rating','remark','is_private'];
    protected $casts=['is_private'=>'boolean'];
    public function customer(){return $this->belongsTo(User::class,'customer_id');}
    public function helper(){return $this->belongsTo(HelperProfile::class,'helper_profile_id');}
    public function booking(){return $this->belongsTo(Booking::class);}
}
