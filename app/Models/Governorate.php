<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Governorate extends Model
{
    use HasFactory;

    protected $table = 'governorates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'governorate_name_ar', 'governorate_name_en'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'governorate_name_ar', 'governorate_name_en'
        );
    }

    public static function getName($id)
    {
        $data = Governorate::select()->find($id);
        if (App::getLocale() == 'ar')
            return $data['governorate_name_ar'];
        elseif (App::getLocale() == 'en')
            return $data['governorate_name_en'];
        else
            return $data['governorate_name_en'];
    }

    public static function getNameEN($id)
    {
        $data = Governorate::select()->find($id);
        if(isset($data->id)){
            return $data['governorate_name_en'];
        }
        return "";
    }

}
