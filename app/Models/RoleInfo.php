<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleInfo extends Model
{
    use HasFactory;

    protected $table = 'role_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'role_id', 'name', 'have_permission', 'admin_id', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'role_id', 'name', 'have_permission', 'admin_id', 'created_at', 'updated_at'
        );
    }

}
