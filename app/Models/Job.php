<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'admin_id', 'title', 'description', 'experience', 'category', 'updated_at','created_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'admin_id', 'title', 'description', 'experience', 'category', 'updated_at','created_at'
        );
    }

}
