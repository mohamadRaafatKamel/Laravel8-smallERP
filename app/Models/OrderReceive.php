<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReceive extends Model
{
    use HasFactory;
    protected $table = 'order_receives';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_id', 'date_receive', 'clearance_id', 'clearance_cost', 'transfer_id', 'transfer_cost', 
        'where', 'customer_id', 'stock_id', 'admin_id', 'status', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'order_id', 'date_receive', 'clearance_id', 'clearance_cost', 'transfer_id', 'transfer_cost', 
            'where', 'customer_id', 'stock_id', 'admin_id', 'status', 'created_at', 'updated_at'         
        );
    }

    public function getClearanceComp()
    {
        $data = ClearanceComp::select()->find($this->clearance_id);
        if(isset($data->id)){
            return $data->name;
        }
        return "";
    }

    public function getTransferComp()
    {
        $data = TransferComp::select()->find($this->transfer_id);
        if(isset($data->id)){
            return $data->name;
        }
        return "";
    }
}
