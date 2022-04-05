<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username','fname','lname','birth_date','email','phone','gender','quick','type','land_mark','floor','apartment',
        'whatapp','whatapp2','age','location','verification','title','password',
        'nationality_code','mobile','address','adress2','code_zone_patient_id','governorate_id','city_id','account_owner_name',
        'account_num','bank_name','identity_id','passport_id','device_token',
    ];

    // public function  scopeSelectionpass($query){

    //     return $query -> select(
    //         'username','fname','lname','birth_date','email','phone','gender','quick','type','land_mark','floor','apartment',
    //         'whatapp','whatapp2','age','location','verification','title','password',
    //         'nationality_code','mobile','address','adress2','code_zone_patient_id','governorate_id','city_id','account_owner_name',
    //         'account_num','bank_name','identity_id','passport_id','device_token',
    //     );
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeDoctor($query){
        return $query -> where('type',2);
    }

    public function scopeNurse($query){
        return $query -> where('type',4);
    }

    public function scopeDriver($query){
        return $query -> where('type',5);
    }

    public function scopeVerification($query){
        return $query -> where('verification',1);
    }

    static public function getUserType($type)
    {
        switch ($type){
            case 1:
                return "Patient";
                break;
            case 2:
                return "Doctors";
                break;
            case 3:
                return "Partners";
                break;
            case 4:
                return "Nurse";
                break;
            case 5:
                return "Driver";
                break;
        }
        return 0;
    }

    static public function getGenderType($gender)
    {
        switch ($gender){
            case 1:
                return "Male";
                break;
            case 2:
                return "Female";
                break;
        }
        return 0;
    }

    public static function getUserName($id)
    {
        $user = User::select('title','username')->find($id);
        if(isset($user))
            return $user['title']." ".$user['username'];
        return "";
    }

    public static function getDocName($id)
    {
        // $user = User::select('title','fname','lname')->find($id);
        $user = User::select('username')->find($id);
        if(isset($user))
            return "Dr ".$user['username'];
        return "";
    }

    static public function getDocDegree($degree)
    {
        switch ($degree){
            case 1:
                return __("Specialist");
                break;
            case 2:
                return __("Consultant");
                break;
            case 3:
                return __("Professor Doctor");
                break;
        }
        return " ";
    }

}
