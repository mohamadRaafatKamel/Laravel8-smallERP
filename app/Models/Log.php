<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    use HasFactory;

    protected $table = 'log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'action', 'action_table', 'action_id', 'info', 'notes', 'admin_id', 'created_at', 'updated_at'
    ];

    public function  scopeSelection($query){

        return $query -> select(
            'id', 'action', 'action_table', 'action_id', 'info', 'notes', 'admin_id', 'created_at', 'updated_at'
        );
    }

    public static function setLog($action,$table,$id,$note,$request)
    {
        try{
            $log = new Log();
            $log->action = $action;
            $log->action_table = $table;
            $log->action_id = $id;
            $log->notes = $note;
            $log->admin_id = Auth::user()->id;
            $log->save();

            if($action == 'update' && $request != ""){
                $oldData = DB::select('select * from '.$table.' where id = ?', [$id])[0];
                // print_r($oldData);
                // print_r($request);
                foreach ($request as $key => $val){
                    // print_r($key);echo"**"; print_r($oldData->$key);echo"//////";
                    if(property_exists($oldData, $key)){
                    // if(isset($oldData->$key)){
                        // print_r($key);echo"**"; print_r($oldData->$key);echo"//////";
                        if($oldData->$key != $val){
                            Log::setLogInfo($oldData->$key, $val, $log->id, $key);
                        }
                    }
                }
                // die();
            }elseif($action == 'delete'){
                $oldData = DB::select('select * from '.$table.' where id = ?', [$id])[0];
                foreach ($oldData as $key => $val){
                    Log::setLogInfo($oldData->$key,"", $log->id, $key);
                }
            }

            return $log->id;
        } catch (\Exception $ex) {
            
        }
    }

    public static function setLogInfo($old_val,$new_val,$log_id,$notes)
    {
        try{
            $loginfo = new LogInfo();
            $loginfo->old_val = $old_val;
            $loginfo->new_val = $new_val;
            $loginfo->log_id  = $log_id ;
            $loginfo->notes = $notes;
            $loginfo->admin_id  = Auth::user()->id;        
            $loginfo->save();
        } catch (\Exception $ex) {
            
        }
    }
}
