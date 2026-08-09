<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['parent_id','name','name_hi','slug','description','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function parent(){ return $this->belongsTo(ServiceCategory::class,'parent_id'); }
    public function children(){ return $this->hasMany(ServiceCategory::class,'parent_id'); }
    public function services(){ return $this->hasMany(Service::class); }
}
