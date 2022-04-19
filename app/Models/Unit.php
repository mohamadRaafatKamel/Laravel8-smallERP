<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'size', 'parent', 'admin_id', 'created_at', 'updated_at', 'status'    
    ];

    public function  scopeSelection($query){
        
        return $query -> select(
            'id', 'name', 'size', 'parent', 'admin_id', 'created_at', 'updated_at', 'status'
        );
    }

    public function scopeActive($query){
        return $query -> where('status',0);
    }

    public function getActive(){
        return   $this -> status == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getParant(){
        return   $this ->getName($this -> parent) ;
    }

    // get parent id of unit sended
    public static function getParantID($unit_id){
        $data = Unit::select()->find($unit_id);
        if(isset($data->id) && isset($data->parent)){
            return $data->parent;
        }
        return false;
    }

    public static function getName($id)
    {
        $data = Unit::select()->find($id);
        if(isset($data->id)){
            return $data['name'];
        }
        return "_";
    }
}
