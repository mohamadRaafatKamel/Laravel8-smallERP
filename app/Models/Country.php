<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_code', 'country_enName', 'country_arName', 'country_enNationality', 'country_arNationality'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'country_code', 'country_enName', 'country_arName', 'country_enNationality', 'country_arNationality'
        );
    }

    public static function getName($id)
    {
        $data = Country::select()->find($id);
        if (App::getLocale() == 'ar')
            return $data['country_arName'];
        elseif (App::getLocale() == 'en')
            return $data['country_enName'];
        else
            return $data['country_enName'];
    }

    public static function getNameEN($id)
    {
        $data = Country::select()->find($id);
        return $data['country_enName'];
    }

}
