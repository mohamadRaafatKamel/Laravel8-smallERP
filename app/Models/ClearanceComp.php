<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearanceComp extends Model
{
    use HasFactory;

    protected $table = 'clearance_comps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'address', 'status', 'phone1', 'phone2', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'name', 'address', 'status', 'phone1', 'phone2', 'admin_id', 'created_at', 'updated_at'    
        );
    }
}
