<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtfolioService extends Model
{
    use HasFactory;

    protected $table = 'protfolio_service';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'admin_id', 'link', 'path', 'title', 'description', 'sort', 'category', 'updated_at','created_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'admin_id', 'link', 'path', 'title', 'description', 'sort', 'category', 'updated_at','created_at'
        );
    }

}
