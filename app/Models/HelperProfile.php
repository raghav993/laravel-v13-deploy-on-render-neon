<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HelperProfile extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id','locality_id','gender','date_of_birth','profile_photo','alternate_contact','bio',
        'experience_years','previous_work_experience','expected_salary','salary_type','work_type',
        'availability_status','immediate_availability','preferred_working_hours','languages',
        'address_line','pincode','latitude','longitude','profile_status'
    ];
    protected $casts = [
        'date_of_birth'=>'date','expected_salary'=>'decimal:2','immediate_availability'=>'boolean',
        'latitude'=>'decimal:7','longitude'=>'decimal:7'
    ];
    public function user(){ return $this->belongsTo(User::class); }
    public function locality(){ return $this->belongsTo(Locality::class); }
    public function services(){ return $this->belongsToMany(Service::class,'helper_service')->withPivot(['experience_years','service_rate','rate_type','is_primary','notes'])->withTimestamps(); }
    public function availabilities(){ return $this->hasMany(HelperAvailability::class); }
    public function scopeActive($query){ return $query->where('profile_status','active')->where('availability_status','!=','unavailable'); }
    public function scopePartTime($query){ return $query->where('work_type','part_time'); }
    public function scopeFullTime($query){ return $query->where('work_type','full_time'); }
}
