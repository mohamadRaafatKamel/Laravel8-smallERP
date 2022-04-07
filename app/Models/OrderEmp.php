<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEmp extends Model
{
    use HasFactory;
    protected $table = 'order_emps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_rec_id', 'employ_id', 'status', 'cost', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'order_rec_id', 'employ_id', 'status', 'cost', 'admin_id', 'created_at', 'updated_at'    
        );
    }
}
