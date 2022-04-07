<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPay extends Model
{
    use HasFactory;
    protected $table = 'order_pays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_id', 'serial', 'date', 'payed', 'status', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'order_id', 'serial', 'date', 'payed', 'status', 'admin_id', 'created_at', 'updated_at'    
        );
    }
}
