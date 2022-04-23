<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'contract_no', 'date_order', 'status', 'date_arrive', 'payment_way', 'supplier_id', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'contract_no', 'date_order', 'status', 'date_arrive', 'payment_way', 'supplier_id', 'admin_id', 'created_at', 'updated_at'    
        );
    }

    public function getStatus(){
        switch( $this ->status){
            case 0 :
                return __('Open');
            case 5 :
                return __('Hold');
            case 10 :
                return __('Done');
        }
        return "";
    }
}
