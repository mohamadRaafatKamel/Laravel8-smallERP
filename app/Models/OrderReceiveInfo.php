<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReceiveInfo extends Model
{
    use HasFactory;
    protected $table = 'order_receive_infos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_id', 'order_receive_id', 'product_id', 'product_cat', 'unit_id', 'amount', 
        'admin_id', 'status', 'created_at', 'updated_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'order_id', 'order_receive_id', 'product_id', 'product_cat', 'unit_id', 'amount', 
            'admin_id', 'status', 'created_at', 'updated_at', 'updated_at'         
        );
    }
}
