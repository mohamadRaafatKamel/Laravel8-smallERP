<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class RequestCall extends Model
{
    use HasFactory;

    protected $table = 'request_call';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'admin_id', 'department', 'call_time', 'request_id', 'note', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'admin_id', 'department', 'call_time', 'request_id', 'note', 'created_at', 'updated_at'
        );
    }

    static public function getDepartment($id)
    {
        switch ($id){
            case 1:
                return __("Call Center");
                break;
            case 2:
                return __("Out Patient");
                break;
            case 3:
                return __("In Patient");
                break;
        }
        return 0;
    }
    
    public static function getCallsTime($id)
    {
        try{
            $mycall = [];
            $calls = RequestCall::select()->where('request_id',$id)->get();

            if($calls){
                if($calls->count()>0){
                    foreach ($calls as $call){
                        $mycall[]= $call->call_time;
                    }
                }
            }
            return $mycall;
        } catch (\Exception $ex) {
        }
    }

}
