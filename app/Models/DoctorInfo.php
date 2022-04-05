<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorInfo extends Model
{
    use HasFactory;

    protected $table = 'doctor_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'specialty', 'slot_time', 'over_slot', 'degree', 'cv', 'phone1', 'phone2', 'photo', 'description', 
        'available_time', 'updated_at','created_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'user_id', 'specialty', 'slot_time', 'over_slot', 'degree', 'cv', 'phone1', 'phone2', 'photo', 'description', 
            'available_time', 'updated_at','created_at'        
        );
    }

}
