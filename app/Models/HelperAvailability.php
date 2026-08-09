<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelperAvailability extends Model
{
    use HasFactory;
    protected $fillable = ['helper_profile_id','day_of_week','start_time','end_time','preference'];
    public function helper(){ return $this->belongsTo(HelperProfile::class,'helper_profile_id'); }
    public function scopeOnDay($query, int $day){ return $query->where('day_of_week',$day); }
    public function scopeBetween($query, string $start, string $end){
        return $query->where('start_time','<=',$start)->where('end_time','>=',$end);
    }
}
