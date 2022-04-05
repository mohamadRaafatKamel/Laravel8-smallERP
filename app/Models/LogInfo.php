<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogInfo extends Model
{
    use HasFactory;

    protected $table = 'log_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'old_val', 'new_val', 'log_id ', 'notes', 'admin_id', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'old_val', 'new_val', 'log_id ', 'notes', 'admin_id', 'created_at', 'updated_at'
        );
    }

}
