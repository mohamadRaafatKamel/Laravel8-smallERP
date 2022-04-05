<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class RequestAction extends Model
{
    use HasFactory;

    protected $table = 'request_action';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'service_id', 'request_id', 'action_date', 'price', 'state', 'note', 'admin_id', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){
        return $query -> select(
            'id', 'service_id', 'request_id', 'action_date', 'price', 'state', 'note', 'admin_id', 'created_at', 'updated_at'
        );
    }

    static public function getState($state)
    {
        switch ($state){
            case 0:
                return __("No");
                break;
            case 1:
                return __("Yes");
                break;
        }
        return "_";
    }

    // public static function getServesList($id)
    // {
    //     try{
    //         $myserv = [];
    //         $servs = RequestAction::select()->where('request_id',$id)->get();

    //         if($servs){
    //             if($servs->count()>0){
    //                 foreach ($servs as $serv){
    //                     $myserv[]= $serv->call_time;
    //                 }
    //             }
    //         }
    //         return $myserv;
    //     } catch (\Exception $ex) {
    //     }
    // }

}
