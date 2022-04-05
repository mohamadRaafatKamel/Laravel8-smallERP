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
        'id', 'order_id', 'product_id', 'unit_id', 'amount', 'price', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'order_id', 'product_id', 'unit_id', 'amount', 'price', 'admin_id', 'created_at', 'updated_at'    
        );
    }
}
