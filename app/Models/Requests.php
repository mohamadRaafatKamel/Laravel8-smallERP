<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'request';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'doctor_id', 'nurse_id', 'fullname', 'name_caregiver', 'gender', 'location', 
        'governorate_id', 'city_id', 'adress', 'land_mark', 'floor', 'apartment', 'phone', 'phone2', 'whatapp', 
        'whatapp2', 'whatsApp_group', 'age', 'corporate_id', 'physician', 'type',  'medical_type_id',
        'specialty_id', 'package_id', 'visit_time_day', 'visit_time_from', 'visit_time_to',  // 'service_id', 'covid19', 
        'expectation_cost', 'real_cost', 'bill_serial', 'pay_or_not', 'code_zone_patient_id', 'bed_number', 
        'symptoms', 'doc_note', 'come_from', 'reason_out', 'Long', 'date_out', 'date_in', 'diagnose', 'history', 'co', 
        'feedback', 'doc_rate', 'user_rate', 'opd_admin_id', 'opd2_admin_id', 'cc_admin_id', 'adress2', 'price_list_id',
        'admin_id_in_out', 'status_doc', 'status_user', 'status_cc', 'status_in_out', 'created_at', 
        'updated_at','driver_id', 'created_by', 'reason_cancel', 'schedule_date', 'end_service_date',
        'nurse_evaluation', 'satisfaction', 'nomination_rate', 'speed_services_overall'
    ];

    public function  scopeSelection($query){
        $query -> where('id','!=',0);
        return $query -> select(
            'id', 'user_id', 'doctor_id', 'nurse_id', 'fullname', 'name_caregiver', 'gender', 'location', 
            'governorate_id', 'city_id', 'adress', 'land_mark', 'floor', 'apartment', 'phone', 'phone2', 'whatapp', 
            'whatapp2', 'whatsApp_group', 'age', 'corporate_id', 'physician', 'type',  'medical_type_id',
            'specialty_id', 'package_id', 'visit_time_day', 'visit_time_from', 'visit_time_to',  // 'service_id', 'covid19',
            'expectation_cost', 'real_cost', 'bill_serial', 'pay_or_not', 'code_zone_patient_id', 'bed_number', 
            'symptoms', 'doc_note', 'come_from', 'reason_out', 'Long', 'date_out', 'date_in', 'diagnose', 'history', 'co', 
            'feedback', 'doc_rate', 'user_rate', 'opd_admin_id', 'opd2_admin_id', 'cc_admin_id', 'adress2', 'price_list_id',
            'admin_id_in_out', 'status_doc', 'status_user', 'status_cc', 'status_in_out', 'created_at', 
            'updated_at','driver_id', 'created_by', 'reason_cancel', 'schedule_date', 'end_service_date',
            'nurse_evaluation', 'satisfaction', 'nomination_rate', 'speed_services_overall'
        );
    }

    public function getMyType(){
        return $this->getRequestType($this->type);
    }

    public function getMyCalls(){
        return RequestCall::getCallsTime($this->id);
    }

    static public function getRequestType($type)
    {
        switch ($type){
            case 1:
                return __("Emergency Call");
                break;
            case 2:
                return __("Out Patient");
                break;
            case 3:
                return __("In Patient");
                break;
            case 4:
                return __("Lab");
                break;
        }
        return "_";
    }

    static public function getRequestState($state)
    {
        switch ($state){
            case 1:
                return __('New Request');
                break;
            case 2:
                return __('Hold');
                break;
            case 6:
                return __('Hold to Approve') ;
                break;
            case 7:
                return __('Following') ;
                break;
            case 4:
                return __('DONE') ;
                break;
            case 5:
                return __('Cancel') ;
                break;
        }
        return "_";
    }

    static public function getStateColor($state)
    {
        switch ($state){
            case 1:
                return "badge-danger";
                break;
            case 2:
                return 'badge-warning';
                break;
            case 6:
                return 'badge-warning';
                break;
            case 7:
                return 'badge-warning';
                break;
            case 4:
                return 'badge-success';
                break;
            case 5:
                return 'badge-secondary';
                break;
        }
        return "_";
    }

    public function getCreateBy($user)
    {
        if($user == "WebUser")
            return "Web User";
        elseif($user == "WebGuest")
            return "Web Guest";
            
        if($user == "AppUser")
            return "App User";
        elseif($user == "AppGuest")
            return "App Guest";
        else{
            $admin = Admin::select()->find($user);
            if(isset($admin->name))
                return $admin->name;
            else
                return '_';
        }
        return '_';
    }

    // public static function getAddress($id)
    // {
    //     $address = "";
    //     $data = Order::select()->find($id);
    //     if(isset($data->id)){
    //         $address .= Governorate::getName($data->governorate_id).",<br>";
    //         $address .= City::getName($data->city_id ).", <br/> ";
    //         $address .= $data->adress;
    //         if ($data->adress2 != ""){
    //             $address .= ",<br/>".$data->adress.".";
    //         }else{
    //             $address .= '.';
    //         }
    //     }
    //     return $address;
    // }

    
    // static public function getOrderStates($states)
    // {
    //     switch ($states){
    //         case 1:
    //             return __("Waiting");
    //             break;
    //         case 2:
    //             return __("Coming");
    //             break;
    //         case 3:
    //             return __("Medical assessment");
    //             break;
    //         case 4:
    //             return __("Finish");
    //             break;
    //         case 8:
    //             return __("Draft");
    //             break;
    //         case 9:
    //             return __("Cancel");
    //             break;

    //         case 29:
    //             return __("Doctor Cancel");
    //             break;
    //     }
    //     return 0;
    // }


}
