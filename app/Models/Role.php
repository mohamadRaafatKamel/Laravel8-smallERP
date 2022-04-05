<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'name', 'created_at', 'updated_at'
        );
    }

    public static function havePremission ($permissionName)
    {
        $userRole = Auth::user()->permission;
        if($userRole != '0'){
            foreach($permissionName as $permisson){
                $role = RoleInfo::select()->where([
                    ['name','=',$permisson],
                    ['role_id','=',$userRole]
                ])->first();
                if(isset($role['have_permission'])){
                    if($role['have_permission'] == '1'){
                        return true;
                    }
                }
            }
        }else{
            return true;
        }
        return false;
    }

}
