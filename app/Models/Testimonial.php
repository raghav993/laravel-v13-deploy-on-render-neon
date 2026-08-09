<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Testimonial extends Model {
    use SoftDeletes;
    protected $fillable=['user_id','name','role_label','message','rating','photo','is_approved','sort_order'];
    protected $casts=['is_approved'=>'boolean'];
    public function user(){return $this->belongsTo(User::class);}
}
