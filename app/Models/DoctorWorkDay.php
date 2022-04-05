<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorWorkDay extends Model
{
    use HasFactory;

    protected $table = 'doc_work';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'day', 'time_from', 'time_to', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'user_id', 'day', 'time_from', 'time_to', 'created_at', 'updated_at'
        );
    }

}
