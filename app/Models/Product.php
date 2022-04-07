<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'exp_have', 'exp_long', 'admin_id', 'status', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'name', 'exp_have', 'exp_long', 'admin_id', 'status', 'created_at', 'updated_at'    
        );
    }

    public function scopeActive($query){
        return $query -> where('status',0);
    }

    public function getActive(){
        return   $this -> status == 0 ? 'مفعل'  : 'غير مفعل';
    }

    public function getExpHave(){
        switch( $this ->exp_have){
            case 1 :
                return __('Yes');
            case 0 :
                return __('No');
        }
        return "_";
    }
}
