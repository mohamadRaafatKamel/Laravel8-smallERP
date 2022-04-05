<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Service extends Model
{
    use HasFactory;

    protected $table = 'service';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name_ar', 'name_en', 'description', 'category_id', 'image', 'type', 'site', 'admin_id', 'disabled', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'name_ar', 'name_en', 'description', 'category_id', 'image', 'type', 'site', 'admin_id', 'disabled', 'created_at', 'updated_at'
        );
    }

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function scopeLab($query){
        return $query -> where('type',3);
    }

    public function scopeNotlab($query){
        return $query -> where('type','!=',3);
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getMyType(){
        return $this->getServiceType($this->type) ;
    }

    public static function getName($id)
    {
        $data = Service::select()->find($id);
        if(isset($data->id)){
            if (App::getLocale() == 'ar')
                return $data['name_ar'];
            elseif (App::getLocale() == 'en')
                return $data['name_en'];
            else
                return $data['name_en'];
        }
        return "";
    }

    public static function getNameEN($id)
    {
        $data = Service::select()->find($id);
        if(isset($data->id)){
            return $data['name_en'];
        }
        return "";
    }

    public static function getIDformNameEN($name)
    {
        $data = Service::select('id')->where('name_en',$name)->first();
        if(isset($data->id)){
            return $data['id'];
        }
        return null;
    }

    public static function getPrice($pl, $id)
    {
        if($pl == 0 || $pl == null){
            $pl = PriceList::getMainPL();
        }
        $data = PriceListInfo::select('price')->where('service_id',$id)->where('price_list_id',$pl)->first();
        if(isset($data->price)){
            return $data->price;
        }
        return 0;
    }

    static public function getServiceType($type)
    {
        switch ($type){
            case 1:
                return __('InPatient');
                break;
            case 2:
                return __('OutPatient');
                break;
            case 3:
                return __('Lab');
                break;
        }
       return "_";
    }

}
