<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['service_category_id','name','name_hi','slug','description','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function category(){ return $this->belongsTo(ServiceCategory::class,'service_category_id'); }
    public function helpers(){ return $this->belongsToMany(HelperProfile::class,'helper_service')->withPivot(['experience_years','service_rate','rate_type','is_primary','notes'])->withTimestamps(); }
}
