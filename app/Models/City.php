<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'governorate_id', 'city_name_ar', 'city_name_en'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'governorate_id', 'city_name_ar', 'city_name_en'
        );
    }

    public static function getName($id)
    {
        $data = City::select()->find($id);
        if(isset($data->id)){
            if (App::getLocale() == 'ar')
                return $data['city_name_ar'];
            elseif (App::getLocale() == 'en')
                return $data['city_name_en'];
            else
                return $data['city_name_en'];
        }
        return "";
    }

    public static function getNameEN($id)
    {
        $data = City::select()->find($id);
        if(isset($data->id)){
            return $data['city_name_en'];
        }
        return "";
    }

}
