<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Referral extends Model
{
    use HasFactory;

    protected $table = 'referral';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name_ar', 'name_en', 'description', 'cat_id', 'admin_id', 'disabled', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'name_ar', 'name_en', 'description', 'cat_id', 'admin_id', 'disabled', 'created_at', 'updated_at'
        );
    }

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function getActive(){
        return   $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public static function getAllReferral()
    {
        try{
            $myref = [];
            $referrals = Referral::select('id', 'name_ar')->active()->get();
            $doctors = User::select('id', 'username')->doctor()->get();
            if($referrals){
                if($referrals->count()>0){
                    foreach ($referrals as $referral){
                        $row = [];
                        $row['id']= "ref_".$referral->id;
                        $row['name']= $referral->name_ar;
                        $myref[]= $row;
                    }
                }
                
            }
            if($doctors){
                if($doctors->count()>0){
                    foreach ($doctors as $doctor){
                        $row = [];
                        $row['id']= "doc_".$doctor->id;
                        $row['name']= $doctor->username;
                        $myref[]= $row;
                    }
                }
            }
            return $myref;
        } catch (\Exception $ex) {
        }
    }

    public static function getName($id)
    {
        $data = Referral::select()->find($id);
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
        $data = Referral::select()->find($id);
        if(isset($data->id)){
            return $data['name_en'];
        }
        return "_";
    }


}
