<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class NurseSheet extends Model
{
    use HasFactory;

    protected $table = 'nurse_sheet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nurse_id', 'shift_type', 'shift_date', 'investigation', 'oxygen', 'situation', 'issues', 
        'remarks', 'notes', 'add_devices', 'request_id', 'admin_id', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'nurse_id', 'shift_type', 'shift_date', 'investigation', 'oxygen', 'situation', 'issues', 
            'remarks', 'notes', 'add_devices', 'request_id', 'admin_id', 'created_at', 'updated_at'
        );
    }

    static public function getType($type)
    {
        switch ($type){
            case 1:
                return __("Long");
                break;
            case 2:
                return __("Night");
                break;
            
        }
        return "_";
    }

}
