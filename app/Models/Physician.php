<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Physician extends Model
{
    use HasFactory;

    protected $table = 'physician';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'admin_id', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'name', 'description', 'admin_id', 'created_at', 'updated_at'
        );
    }

    public static function getName($id)
    {
        $data = Physician::select('name')->find($id);
        if(isset($data->name)){
            return $data->name;
        }
        return "";
    }


}
