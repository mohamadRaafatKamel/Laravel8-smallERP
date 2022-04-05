<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'size', 'parent', 'admin_id', 'created_at', 'updated_at'    
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'name', 'size', 'parent', 'admin_id', 'created_at', 'updated_at'    
        );
    }
}
