<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locality extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['city_id','name','slug','pincode','latitude','longitude'];
    public function city(){ return $this->belongsTo(City::class); }
    public function helpers(){ return $this->hasMany(HelperProfile::class); }
    public function customers(){ return $this->hasMany(CustomerProfile::class); }
}
