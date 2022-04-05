<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Package extends Model
{
    use HasFactory;

    protected $table = 'package';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name_ar', 'name_en', 'price', 'description', 'admin_id', 'disabled', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'name_ar', 'name_en', 'price', 'description', 'admin_id', 'disabled', 'created_at', 'updated_at'
        );
    }

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getMyName(){
        return   $this->getName($this -> id);
    }

    public static function getName($id)
    {
        $data = Package::select()->find($id);
        if(isset($data->id)){
            if (App::getLocale() == 'ar')
                return $data['name_ar'];
            elseif (App::getLocale() == 'en')
                return $data['name_en'];
            else
                return $data['name_en'];
        }
        return "_";
    }

    public static function getNameEN($id)
    {
        $data = Package::select()->find($id);
        if(isset($data->id)){
            return $data['name_en'];
        }
        return "_";
    }

    public static function getPrice($pl, $id)
    {
        $data = PriceListInfo::select('price')->where('package_id',$id)->where('price_list_id',$pl)->first();
        if(isset($data->price)){
            return $data->price;
        }
        return "0";
    }


}
