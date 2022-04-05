<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name_ar', 'name_en', 'parent_id', 'admin_id', 'disabled', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){
        $query -> where('disabled','!=',9); // Not Deleted 
        // $query -> where('disabled','!=',1); // Not disabled 
        return $query -> select(
            'id', 'name_ar', 'name_en', 'parent_id', 'admin_id', 'disabled', 'created_at', 'updated_at'
        );
    }

    public function scopeGeneral($query){
        return $query -> where('parent_id',null);
    }

    public function scopeMain($query){
        return $query -> where('parent_id','!=',null);
    }

    public function scopeActive($query){
        return $query -> where('disabled',0);
    }

    public function getActive(){
        return $this -> disabled == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getVal($datas)
    {
        $generals = [];
        foreach($datas as $data){
            $row = [];
            $row['id']= $data->id;
            $row['name_ar']= $data->name_ar;
            $row['name_en']= $data->name_en;
            $row['parent_id']= $this->getName($data->parent_id);
            $row['disabled']= $data->getActive();
            $row['admin_id']= Admin::getAdminNamebyId($data->admin_id);
            $row['created_at']= $data->created_at;
            $generals[] = $row;
        }
        return $generals;
    }

    public static function getName($id)
    {
        $data = Category::select()->find($id);
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
        $data = Category::select()->find($id);
        if(isset($data->id)){
            return $data['name_en'];
        }
        return "_";
    }

    public static function getIDformNameEN($name)
    {
        $data = Category::select('id')->where('name_en',$name)->first();
        if(isset($data->id)){
            return $data['id'];
        }
        return null;
    }

}
