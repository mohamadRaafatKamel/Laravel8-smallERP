<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'phone1', 'phone2', 'status', 'address', 'opening_balance', 'arrive_long', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'name', 'phone1', 'phone2', 'status', 'address', 'opening_balance', 'arrive_long', 'admin_id', 'created_at', 'updated_at'    
        );
    }

    public function scopeActive($query){
        return $query -> where('status',0);
    }
    
    public function getActive(){
        return   $this -> status == 0 ? 'مفعل'  : 'غير مفعل';
    }

}
