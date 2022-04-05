<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employ extends Model
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
}
