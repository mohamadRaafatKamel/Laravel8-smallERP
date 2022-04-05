<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PriceListInfo extends Model
{
    use HasFactory;

    protected $table = 'price_list_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'price', 'service_id', 'package_id', 'price_list_id', 'admin_id', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'price', 'service_id', 'package_id', 'price_list_id', 'admin_id', 'created_at', 'updated_at'
        );
    }

    public function getService (){
        return   Service::getName($this -> service_id) ;
    }

    public function getPackage (){
        return   Package::getName($this -> package_id) ;
    }

}
