<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferComp extends Model
{
    use HasFactory;
    protected $table = 'transfer_comps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'address', 'phone1', 'status', 'phone2', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'name', 'address', 'phone1', 'status', 'phone2', 'admin_id', 'created_at', 'updated_at'    
        );
    }
}
