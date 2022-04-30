<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInfo extends Model
{
    use HasFactory;
    protected $table = 'stock_infos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'stock_id', 'product_id', 'product_cat', 'unit_id', 'amount', 'admin_id', 'status', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'stock_id', 'product_id', 'product_cat', 'unit_id', 'amount', 'admin_id', 'status', 'created_at', 'updated_at'    
        );
    }
}
