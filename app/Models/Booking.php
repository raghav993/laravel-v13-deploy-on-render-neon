<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Booking extends Model {
    protected $fillable = ['customer_id','helper_profile_id','service_id','booking_date','start_time','duration_hours','agreed_amount','status','customer_note','helper_note','admin_note'];
    protected $casts = ['booking_date'=>'date','agreed_amount'=>'decimal:2'];
    public function customer(){ return $this->belongsTo(User::class,'customer_id'); }
    public function helper(){ return $this->belongsTo(HelperProfile::class,'helper_profile_id'); }
    public function service(){ return $this->belongsTo(Service::class); }
    public function remarks(){ return $this->hasMany(HelperRemark::class); }
}
