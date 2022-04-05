<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
        'permission',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function  scopeSelection($query){

        return $query -> select('id','name', 'email','photo','permission', 'password', 'created_at', 'updated_at');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getRoleNamebyId($id)
    {
        $role = Role::select('name')->find($id);
        if(isset($role->name)){
            return $role['name'];
        }
        
    }

    public static function getAdminNamebyId($id)
    {
        $role = Admin::select('name')->find($id);
        if(isset($role->name)){
            return $role['name'];
        }
    }
}
