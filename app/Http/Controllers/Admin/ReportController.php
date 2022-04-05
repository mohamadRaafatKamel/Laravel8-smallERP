<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Physician;
use App\Models\ReferalCat;
use App\Models\Referral;
use App\Models\RequestCall;
use App\Models\Requests;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use App\Models\UsersReferral;
use GuzzleHttp\Psr7\Request;

class ReportController extends Controller
{
    public function indexOut()
    {
        if(! Role::havePremission(['report_view']))
            return redirect()->route('admin.dashboard');

        $query = Requests::selection()->where('status_cc',4);
        $requests = [];
        $usersReferrals= [];
        $cats =[];
        if(!empty($_GET)){
            // Type
            if(isset($_GET['type']) && $_GET['type'] != "")
                if($_GET['type'] < 5 && $_GET['type'] > 0)
                    $query = $query->where('type',$_GET['type']);

            // State
            if(isset($_GET['state']) && $_GET['state'] != "")
                if($_GET['state'] < 8 && $_GET['state'] > 0 && $_GET['state'] != 3)
                    $query = $query->where('status_in_out',$_GET['state']);

            // Schedule date
            if(isset($_GET['date_from']) && isset($_GET['date_to']) && $_GET['date_from'] != "" && $_GET['date_to'] != ""){
                if($_GET['date_from'] <  $_GET['date_to'] ){
                    if(isset($_GET['date']))
                        // not all date
                        if($_GET['date'] != ""){
                            if($_GET['date'] == "Schedule")
                                $query = $query->whereBetween('schedule_date', [$_GET['date_from'], $_GET['date_to']]);
                            elseif($_GET['date'] == "ServiceEnd")
                                $query = $query->whereBetween('end_service_date', [$_GET['date_from'], $_GET['date_to']]);
                            elseif($_GET['date'] == "RequestEnd")
                                $query = $query->whereBetween('date_out', [$_GET['date_from'], $_GET['date_to']]);
                            elseif($_GET['date'] == "Created")
                                $query = $query->whereBetween('created_at', [$_GET['date_from'], $_GET['date_to']]);
                        }else{
                            $query = $query->orWhereBetween('schedule_date', [$_GET['date_from'], $_GET['date_to']]);
                            $query = $query->orWhereBetween('end_service_date', [$_GET['date_from'], $_GET['date_to']]);
                            $query = $query->orWhereBetween('date_out', [$_GET['date_from'], $_GET['date_to']]);
                            $query = $query->orWhereBetween('created_at', [$_GET['date_from'], $_GET['date_to']]);
                        }
                    $query = $query->whereBetween('schedule_date', [$_GET['date_from'], $_GET['date_to']]);
                }else{
                    $erorrMsg = "تاريخ من يجب ان يكون قبل الي";
                    return view('admin.report.indexout', compact('requests','usersReferrals','cats','erorrMsg'));
                }
            }elseif($_GET['date_from'] != "" || $_GET['date_to'] != ""){
                $erorrMsg = "تاريخ من و الي يجب ادخالهم";
                return view('admin.report.indexout', compact('requests','usersReferrals','cats','erorrMsg'));
            }
            // elseif (isset($_GET['date_from']) && $_GET['date_from'] != "")
            //     $query = $query->whereDate('schedule_date','>',$_GET['date_from']);
            // elseif (isset($_GET['date_to']) && $_GET['date_to'] != "")
            //     $query = $query->whereDate('schedule_date','<',$_GET['date_to']);
        }
        
        $requests = $query->paginate(PAGINATION_COUNT);
        
        if(count($requests) > 0){
            foreach($requests as $request){
                // phone
                if($request->phone2 != ""){
                    $request->phone .= ", ". $request->phone2;
                }
                // covid19
                if($request->covid19 == 0){
                    $request->covid19 = "No";
                }elseif($request->covid19 == 1){
                    $request->covid19 = "Yes";
                }else{
                    $request->covid19 = "_";
                }
                //pay_or_not
                if($request->pay_or_not == 0){
                    $request->pay_or_not = "No";
                }elseif($request->pay_or_not == 1){
                    $request->pay_or_not = "Yes";
                }else{
                    $request->pay_or_not = "_";
                }
                // OPD
                $request -> opd_admin_id = Admin::getAdminNamebyId($request->opd_admin_id );
                // CC
                $request -> cc_admin_id = Admin::getAdminNamebyId($request->cc_admin_id );
                // Doctor
                $request -> doctor_id = User::getDocName($request->doctor_id );
                // Nurse 
                $request -> nurse_id = User::getUserName($request->nurse_id );
                // Physician 
                $request -> physician = Physician::getName($request->physician );
                // Service 
                $request -> service_id = Service::getName($request->service_id );
                // Address
                $addrss = "";
                if(isset($request->apartment)) $addrss .= __('Apartment').": ".$request->apartment.", "; 
                if(isset($request->floor)) $addrss .= __('Floor').": ".$request->floor.", ";
                if(isset($request->land_mark)) $addrss .= __('Land Mark').": ".$request->land_mark.", ";
                if(isset($request->adress)) $addrss .= $request->adress.", ";
                if(isset($request->city_id)) $addrss .= $request->city_id;
                $request->adress = $addrss;
                
                // Referral
                if(isset($request->user_id)){
                    $usersReferrals = $this->reportReferral(UsersReferral::getReferral($request->user_id));
                }
                $request -> status_cc = $usersReferrals;
                // dd($request -> status_cc);

                // Referral Category
                $cats = [
                    "Doctor" => "Doctor",
                    "Other" => "Other"
                ];
                $allCats= ReferalCat::select('id', 'name')->get();
                foreach($allCats as $allCat){
                    $cats[$allCat->id] = $allCat->name;
                }
            }
            
            
        }
        return view('admin.report.indexout', compact('requests','usersReferrals','cats'));
    }

    public function reportReferral($Referrals)
    {
        $cats = [
            "Doctor" => "",
            "Other" => ""
        ];
        if(count($Referrals) > 0){
            $allCats= ReferalCat::select('id', 'name')->get();
            foreach($allCats as $allCat){
                $cats[$allCat->id] = "";
            }
            foreach($Referrals as $Referral){
                $x = explode("_", $Referral);
                if($x[0] == "doc"){
                    $cats['Doctor'] .= User::getDocName($x[1]).";";
                }elseif($x[0] == "ref"){
                    $myref = Referral::select('id', 'name_ar','cat_id')->find($x[1]);
                    if(isset($myref->id)){
                        if(isset($myref->cat_id)){
                            $cats[$myref->cat_id] .= $myref->name_ar.";";
                        }else{
                            $cats['Other'] .= $myref->name_ar.";";
                        }
                    }
                }
            }
        }
        return $cats;
    }

}
