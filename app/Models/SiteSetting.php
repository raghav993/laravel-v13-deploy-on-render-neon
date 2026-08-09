<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SiteSetting extends Model {
    protected $fillable=['key','value','type'];
    public static function get(string $key, $default=null){
        $item=static::where('key',$key)->first();
        if(!$item) return $default;
        return $item->type==='boolean' ? filter_var($item->value,FILTER_VALIDATE_BOOLEAN) : $item->value;
    }
    public static function set(string $key, $value, string $type='text'){
        return static::updateOrCreate(['key'=>$key],['value'=>$value,'type'=>$type]);
    }
}
