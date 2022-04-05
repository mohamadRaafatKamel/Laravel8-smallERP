<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PriceList extends Model
{
    use HasFactory;

    protected $table = 'price_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'main_pl', 'copy_from', 'admin_id', 'status', 'disabled', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'name', 'main_pl', 'copy_from', 'admin_id', 'status', 'disabled', 'created_at', 'updated_at'
        );
    }

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public static function getMainPL(){
        $data = PriceList::select('id')->where('main_pl',1)->first();
        return $data->id;
    }

    public static function getPriceList($medType, $company)
    {
        if($company == null && $medType == null){
            return PriceList::getMainPL();
        }
        if($company != null && $medType != null){
            $type = MedicalType::select()->find($medType);
            if(isset($type->id))
                return $type->price_list_id;
        }
        if($company == null && $medType != null){
            $type = MedicalType::select()->find($medType);
            if(isset($type->id))
                return $type->price_list_id;
        }else
        if($company != null && $medType == null){
            $comp = CompanyInfo::select()->find($company);
            if(isset($comp->id))
                return $comp->price_list_id;
        }
        
        return "0";
    }


}
