<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    use HasFactory;
    protected $table = 'order_infos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_id', 'product_id', 'product_cat', 'unit_id', 'status', 'amount', 'price', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'order_id', 'product_id', 'product_cat', 'unit_id', 'status', 'amount', 'price', 'admin_id', 'created_at', 'updated_at'    
        );
    }

    public function getUnit(){
        return Unit::getName($this->unit_id) ;
    }

    public function getProduct(){
        return Product::getName($this->product_id) ;
    }
}
