<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBuy extends Model
{
    use HasFactory;
    protected $table = 'product_buys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'product_id', 'category', 'amount', 'status', 'unit_id', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        $query -> where('status','!=','99');
        return $query -> select(
            'id', 'product_id', 'category', 'amount', 'status', 'unit_id', 'admin_id', 'created_at', 'updated_at'    
        );
    }

    public function scopeActive($query){
        return $query -> where('status',0);
    }

    public function getActive(){
        return   $this -> status == 0 ? 'مفعل'  : 'غير مفعل';
    }
}
