<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\RequestCall;
use App\Models\Requests;
use App\Models\Role;
use App\Models\City;
use App\Models\CompanyInfo;
use App\Models\Governorate;
use App\Models\NurseSheet;
use App\Models\Package;
use App\Models\Referral;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Specialty;
use App\Models\User;
use App\Mail\requestMail;
use App\Models\Log;
use App\Models\MedicalType;
use App\Models\Physician;
use App\Models\PriceList;
use App\Models\RequestAction;
use App\Models\UsersReferral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;
use Prophecy\Call\Call;

class RequestController extends Controller
{
    //  CC 
    public function indexCC()
    {
        //
        // $queryxx = Requests::select()->where('schedule_date',null)->get();
        // foreach($queryxx as $row){
        //     if($row->end_service_date != null)
        //         $row->update(['schedule_date'=> $row->end_service_date]) ;
        // }
        // dd("done");
        //
        if(! Role::havePremission(['request_all']))
            return redirect()->route('admin.dashboard');

        $query = Requests::selection();
        if(empty($_GET)){
            $_GET['state'] = 1;
        }
        // State
        if(isset($_GET['state']) && $_GET['state'] != "")
            if($_GET['state'] < 8 && $_GET['state'] > 0 && $_GET['state'] != 3)
                $query = $query->where('status_cc',$_GET['state']);
        
        $requests = $query->paginate(PAGINATION_COUNT);
        return view('admin.request.indexcc', compact('requests'));
    }

    public function createCC()
    {
        if(! Role::havePremission(['request_all','request_emergency']))
            return redirect()->route('admin.dashboard');

        if(isset($_GET['req'])) $req=$_GET['req']; else $req=0;

        date_default_timezone_set('Africa/Cairo');
        $datenaw = date("Y-m-d")."T".date("H:i:s");

        $specialtys = Specialty::select()->active()->get();
        $users = User::select()->get();
        $governorates = Governorate::select()->get();
        $citys = City::select()->get();
        $companys = CompanyInfo::select()->get();
        $packages = Package::select()->get();
        $physicians = Physician::select()->get();
        $myorder = Requests::select()->find($req);
        $calls = RequestCall::select()->where('request_id',$req)->get();
        $actions = RequestAction::select()->where('request_id',$req)->get();
        $referrals = Referral::getAllReferral();
        $medicalTypes = MedicalType::select()->get();
        
        $usersReferrals= [];
        if(isset($myorder->user_id)){
            $usersReferrals = UsersReferral::getReferral($myorder->user_id);
        }
        

        return view('admin.request.createcc',compact('users','medicalTypes','actions','usersReferrals','companys','referrals','physicians','packages','calls','governorates','citys','specialtys','myorder','datenaw'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['request_all','request_emergency']))
            return redirect()->route('admin.dashboard');

        // Add User
        if (!$request->has('user_id') || $request->user_id == null ){ 
            if ($request->has('phone')){
                $request->validate([
                    'phone'=>"unique:users,phone|required",
                    'fullname'=>"required",
                ]);
                $userID = $this->addUser($request->fullname,$request->phone);
                $request->request->add(['user_id' => $userID ]);
            }
        }

        try {

            if (!$request->has('whatapp'))
                $request->request->add(['whatapp' => 0]);
            if (!$request->has('whatapp2'))
                $request->request->add(['whatapp2' => 0]);

            // Add Physician
            if (!$request->has('physician') || $request->physician == null ){
                if ( $request->has('physician_new')){
                    $phyID = $this->AddPhysician( $request->physician_new );
                    $request->request->add(['physician' => $phyID ]);
                }
            }

            // Referral
            if(isset($request->referral_id)){
                if(count($request->referral_id) > 0){
                    UsersReferral::setReferral($request->user_id, $request->referral_id);
                    $request->request->remove('referral_id');
                }
            }

            if($request->btn == "done"){
                $request->request->add(['status_cc' => 4]);
                if($request->type == '2')
                    $this->requestMail($request, "InPatient");
                if($request->type == '3')
                    $this->requestMail($request, "OutPatient");
            }else{
                $request->request->add(['status_cc' =>  '2']);
            }
             
            $request->request->add(['cc_admin_id' =>  Auth::user()->id]);
            $request->request->add(['created_by' =>  Auth::user()->id]);

            $req = Requests::create($request->except(['_token']));
            Log::setLog('create','request',$req->id,"","");

            // add call
            if ($request->has('time') || $request->has('note') ){
                if($request->note != "" || $request->time != ""){
                    $this->AddCall($request->time, $request->note, $req->id, '1');
                }
            }

            if($request->btn == "saveAndNew")
                return redirect()->route('admin.request.create.cc',['req'=>$req->id])->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.request.cc')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.request.create.cc')->with(['error'=>'يوجد خطء']);
        }
    }

    public function update(Request $request, $id)
    {
        if(! Role::havePremission(['request_all','request_emergency']))
            return redirect()->route('admin.dashboard');

        // Add User
        if (!$request->has('user_id') || $request->user_id == null ){ 
            if ($request->has('phone')){
                $request->validate([
                    'phone'=>"unique:users,phone|required",
                    'fullname'=>"required",
                ]);
                $userID = $this->addUser($request->fullname,$request->phone);
                $request->request->add(['user_id' => $userID ]);
            }
        }

        try {

            if (!$request->has('whatapp'))
                $request->request->add(['whatapp' => 0]);
            if (!$request->has('whatapp2'))
                $request->request->add(['whatapp2' => 0]);

            // Referral
            if(isset($request->referral_id)){
                if(count($request->referral_id) > 0){
                    UsersReferral::setReferral($request->user_id, $request->referral_id);
                    $request->request->remove('referral_id');
                }
            }

            // Add Physician
            if (!$request->has('physician') || $request->physician == null ){
                if ( $request->has('physician_new')){
                    $phyID = $this->AddPhysician( $request->physician_new );
                    $request->request->add(['physician' => $phyID ]);
                    $request->request->remove('physician_new');
                }
            }

            $request->request->add(['cc_admin_id' =>  Auth::user()->id]);
            $data = Requests::find($id);
            if (!$data) {
                return redirect()->route('admin.request.create.cc')->with(['error' => '  غير موجوده']);
            }

            if($request->btn == "done"){
                $request->request->add(['status_cc' => 4]);
                if($request->type == '2')
                    $this->requestMail($request, "InPatient");
                if($request->type == '3')
                    $this->requestMail($request, "OutPatient");
            }elseif($request->btn == "hold")
                $request->request->add(['status_cc' => 2]);
            elseif($request->btn == "cancel")
                $request->request->add(['status_cc' => 5]);
            elseif($request->btn == "approve")
                $request->request->add(['status_cc' => 6]);
            elseif($request->btn == "follow")
                $request->request->add(['status_cc' => 7]);

            // add call
            if ($request->has('time') || $request->has('note') ){
                if($request->note != "" || $request->time != ""){
                    $this->AddCall($request->time, $request->note, $id, '1');
                }
            }

            Log::setLog('update','request',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            if($request->btn == "saveAndNew")
                return redirect()->route('admin.request.create.cc',['req'=>$id])->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.request.cc')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.request.cc')->with(['error'=>'يوجد خطء']);
        }
    }

    //  Em 
    public function indexEm()
    {
        if(! Role::havePremission(['request_emergency']))
            return redirect()->route('admin.dashboard');

        $query = Requests::selection()->where('type',1);
        if(empty($_GET)){
            $_GET['state'] = 1;
        }
        // State
        if(isset($_GET['state']) && $_GET['state'] != "")
            if($_GET['state'] < 8 && $_GET['state'] > 0 && $_GET['state'] != 3)
                $query = $query->where('status_cc',$_GET['state']);
        
        $requests = $query->paginate(PAGINATION_COUNT);
        return view('admin.request.indexem', compact('requests'));
    }

    public function createEM()
    {
        if(! Role::havePremission(['request_emergency']))
            return redirect()->route('admin.dashboard');

        if(isset($_GET['req'])) $req=$_GET['req']; else $req=0;

        date_default_timezone_set('Africa/Cairo');
        $datenaw = date("Y-m-d")."T".date("H:i:s");

        $doctors = User::select('users.id','users.username','doctor_info.degree')->doctor()->Verification()->
                        leftJoin('doctor_info', 'users.id', '=', 'doctor_info.user_id')->get();
        $nurses = User::select()->nurse()->get();
        $serves = Service::select()->active()->notlab()->get();
        $specialtys = Specialty::select()->active()->get();
        $users = User::select()->get();
        $governorates = Governorate::select()->get();
        $citys = City::select()->get();
        $companys = CompanyInfo::select()->get();
        $referrals = Referral::getAllReferral();
        $packages = Package::select()->get();
        $physicians = Physician::select()->get();
        $myorder = Requests::select()->find($req);
        $calls = RequestCall::select()->where('request_id',$req)->get();
        $actions = RequestAction::select()->where('request_id',$req)->get();
        $medicalTypes = MedicalType::select()->get();
        $usersReferrals= [];
        if(isset($myorder->user_id)){
            $usersReferrals = UsersReferral::getReferral($myorder->user_id);
        }
        

        return view('admin.request.createem',compact('users','medicalTypes','actions','usersReferrals','doctors','nurses','companys','referrals','physicians','packages','calls','governorates','citys','specialtys','serves','myorder','datenaw'));
    }

    public function storeEM(Request $request)
    {
        if(! Role::havePremission(['request_all','request_emergency']))
            return redirect()->route('admin.dashboard');

        // Add User
        if (!$request->has('user_id') || $request->user_id == null ){ 
            if ($request->has('phone')){
                $request->validate([
                    'phone'=>"unique:users,phone|required",
                    'fullname'=>"required",
                ]);
                $userID = $this->addUser($request->fullname,$request->phone);
                $request->request->add(['user_id' => $userID ]);
            }
        }

        try {

            
            if (!$request->has('whatapp'))
                $request->request->add(['whatapp' => 0]);
            if (!$request->has('whatapp2'))
                $request->request->add(['whatapp2' => 0]);
            
            if($request->btn == "done"){
                $request->request->add(['status_cc' => 4]);
                if($request->type == '2')
                    $this->requestMail($request, "InPatient");
                if($request->type == '3')
                    $this->requestMail($request, "OutPatient");
            }else{
                $request->request->add(['status_cc' =>  '2']);
            }

            // Add Physician
            if (!$request->has('physician') || $request->physician == null ){
                if ( $request->has('physician_new')){
                    $phyID = $this->AddPhysician( $request->physician_new );
                    $request->request->add(['physician' => $phyID ]);
                }
            }

            // Referral
            if(isset($request->referral_id)){
                if(count($request->referral_id) > 0){
                    UsersReferral::setReferral($request->user_id, $request->referral_id);
                    $request->request->remove('referral_id');
                }
            }

            $request->request->add(['cc_admin_id' =>  Auth::user()->id]);
            $request->request->add(['created_by' =>  Auth::user()->id]);
            
            $req = Requests::create($request->except(['_token']));
            Log::setLog('create','request',$req->id,"","");

            // Action
            if(isset($request->service_id)){
                $btn = null;
                if(isset($request->actionbtn)){
                    if($request->actionbtn == 'takeit') $btn = 1;
                    if($request->actionbtn == 'nottakeit') $btn = 0;
                }
                $this->AddAction($request->action_date,$request->service_id,$req->id,$request->state,$btn);
                $request->request->remove('service_id');
                $request->request->remove('state');
                $request->request->remove('action_date');
            }

            if(isset($request->actionbox) && isset($request->actionbtn)){
                $this->ChangeAction($request->actionbox,$request->actionbtn);
            }

            // add call
            if ($request->has('time') || $request->has('note') ){
                if($request->note != "" || $request->time != ""){
                    $this->AddCall($request->time, $request->note, $req->id, '1');
                }
            }

            if($request->btn == "saveAndNew")
                return redirect()->route('admin.request.create.em',['req'=>$req->id])->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.request.emergency')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.request.create.em')->with(['error'=>'يوجد خطء']);
        }
    }

    public function updateEM(Request $request, $id)
    {
        if(! Role::havePremission(['request_emergency']))
            return redirect()->route('admin.dashboard');

        // Add User
        if (!$request->has('user_id') || $request->user_id == null ){ 
            if ($request->has('phone')){
                $request->validate([
                    'phone'=>"unique:users,phone|required",
                    'fullname'=>"required",
                ]);
                $userID = $this->addUser($request->fullname,$request->phone);
                $request->request->add(['user_id' => $userID ]);
            }
        }

        try {

            if (!$request->has('covid19'))
                $request->request->add(['covid19' => 0]);
            if (!$request->has('whatapp'))
                $request->request->add(['whatapp' => 0]);
            if (!$request->has('whatapp2'))
                $request->request->add(['whatapp2' => 0]);

            // PriceList 
            if( isset($request->medical_type_id) || isset($request->corporate_id) ){
                $pl_ID = PriceList::getPriceList($request->medical_type_id,$request->corporate_id);
            }else{
                $pl_ID = null;
            }
            $request->request->add(['price_list_id' =>  $pl_ID ]);
            
            // Action
            if(isset($request->service_id)){
                $btn = null;
                if(isset($request->actionbtn)){
                    if($request->actionbtn == 'takeit') $btn = 1;
                    if($request->actionbtn == 'nottakeit') $btn = 0;
                }

                $this->AddAction($request->action_date, $request->service_id, $id, $request->state, $pl_ID, $btn);
                $request->request->remove('service_id');
                $request->request->remove('state');
                $request->request->remove('action_date');
            }

            if(isset($request->actionbox) && isset($request->actionbtn)){
                $this->ChangeAction($request->actionbox,$request->actionbtn);
            }

            // Add Physician
            if (!$request->has('physician') || $request->physician == null ){
                if ( $request->has('physician_new')){
                    $phyID = $this->AddPhysician( $request->physician_new );
                    $request->request->add(['physician' => $phyID ]);
                    $request->request->remove('physician_new');
                }
            }

            // Referral
            if(isset($request->referral_id)){
                if(count($request->referral_id) > 0){
                    UsersReferral::setReferral($request->user_id, $request->referral_id);
                    $request->request->remove('referral_id');
                }
            }

            $request->request->add(['cc_admin_id' =>  Auth::user()->id]);
            $data = Requests::find($id);
            if (!$data) {
                return redirect()->route('admin.request.create.em')->with(['error' => '  غير موجوده']);
            }

            if($request->btn == "done"){
                $request->request->add(['status_cc' => 4]);
                if($request->type == '2')
                    $this->requestMail($request, "InPatient");
                if($request->type == '3')
                    $this->requestMail($request, "OutPatient");
            }elseif($request->btn == "hold")
                $request->request->add(['status_cc' => 2]);
            elseif($request->btn == "cancel")
                $request->request->add(['status_cc' => 5]);
            elseif($request->btn == "approve")
                $request->request->add(['status_cc' => 6]);
            elseif($request->btn == "follow")
                $request->request->add(['status_cc' => 7]);

            // add call
            if ($request->has('time') || $request->has('note') ){
                if($request->note != "" || $request->time != ""){
                    $this->AddCall($request->time, $request->note, $id, '1');
                }
            }

            Log::setLog('update','request',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            if($request->btn == "saveAndNew")
                return redirect()->route('admin.request.create.em',['req'=>$id])->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.request.emergency')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.request.emergency')->with(['error'=>'يوجد خطء']);
        }
    }

    //  IN 
    public function indexIN()
    {
        if(! Role::havePremission(['request_in']))
            return redirect()->route('admin.dashboard');

        $query = Requests::selection()->where('type',3)->where('status_cc',4);
        if(empty($_GET)){
            $_GET['state'] = 1;
        }
        // State
        if(isset($_GET['state']) && $_GET['state'] != "")
            if($_GET['state'] < 8 && $_GET['state'] > 0 && $_GET['state'] != 3)
                $query = $query->where('status_in_out',$_GET['state']);
        
        $requests = $query->paginate(PAGINATION_COUNT);
        return view('admin.request.indexin', compact('requests'));
    }

    public function createIN($req)
    {
        if(! Role::havePremission(['request_in']))
            return redirect()->route('admin.dashboard');

        $myorder = Requests::select()->find($req);
        if (!isset($myorder->id)) {
            return redirect()->route('admin.request.in')->with(['error' => '  غير موجوده']);
        }
        
        // how long stay in
        $long = '';
        if(empty($myorder->Long) ){  
            if(isset($myorder->date_in) && isset($myorder->date_out)){
                $interval = date_diff(date_create($myorder->date_in),date_create($myorder->date_out));
                $long = $interval->days;
                $myorder->update(['Long'=>$long ]);
            }
        }else{
            $long = $myorder->Long;
        }

        date_default_timezone_set('Africa/Cairo');
        $datenaw = date("Y-m-d");
        $doctors = User::select('users.id','users.username','doctor_info.degree')->doctor()->Verification()->
                        leftJoin('doctor_info', 'users.id', '=', 'doctor_info.user_id')->get();
        $nurses = User::select()->nurse()->get();
        $serves = Service::select()->active()->notlab()->get();
        $specialtys = Specialty::select()->active()->get();
        $users = User::select()->get();
        $companys = CompanyInfo::select()->get();
        $referrals = Referral::getAllReferral();
        $packages = Package::select()->get();
        $governorates = Governorate::select()->get();
        $calls = RequestCall::select()->where('request_id',$req)->get();
        $sheets = NurseSheet::select()->where('request_id',$req)->get();
        $actions = RequestAction::select()->where('request_id',$req)->get();
        $medicalTypes = MedicalType::select()->get();
        $usersReferrals= [];
        if(isset($myorder->user_id)){
            $usersReferrals = UsersReferral::getReferral($myorder->user_id);
        }
        
        return view('admin.request.createin',compact('datenaw','medicalTypes','long','actions','usersReferrals','users','nurses','sheets','packages','companys','referrals','calls','governorates','specialtys','serves','myorder','doctors'));
    }

    public function updateIN(Request $request, $id)
    {
        if(! Role::havePremission(['request_in']))
            return redirect()->route('admin.dashboard');

        // Add User
        if (!$request->has('user_id') || $request->user_id == null ){ 
            if ($request->has('phone')){
                $request->validate([
                    'phone'=>"unique:users,phone|required",
                    'fullname'=>"required",
                ]);
                $userID = $this->addUser($request->fullname,$request->phone);
                $request->request->add(['user_id' => $userID ]);
            }
        }

        try {
            $data = Requests::find($id);
            if (!$data) {
                return redirect()->route('admin.request.create.in')->with(['error' => '  غير موجوده']);
            }


            if($request->btn == "done")
                $request->request->add(['status_in_out' => 4]);
            elseif($request->btn == "hold")
                $request->request->add(['status_in_out' => 2]);
            elseif($request->btn == "cancel")
                $request->request->add(['status_in_out' => 5]);
            // elseif($request->btn == "approve")
            //     $request->request->add(['status_in_out' => 6]);
            elseif($request->btn == "follow")
                $request->request->add(['status_in_out' => 7]);

            if (!$request->has('whatapp'))
                $request->request->add(['whatapp' => 0]);
            if (!$request->has('whatapp2'))
                $request->request->add(['whatapp2' => 0]);

        
            // PriceList 
            if( isset($request->medical_type_id) || isset($request->corporate_id) ){
                $pl_ID = PriceList::getPriceList($request->medical_type_id,$request->corporate_id);
            }else{
                $pl_ID = null;
            }
            $request->request->add(['price_list_id' =>  $pl_ID ]);
            
            // Action
            if(isset($request->service_id)){
                $btn = null;
                if(isset($request->actionbtn)){
                    if($request->actionbtn == 'takeit') $btn = 1;
                    if($request->actionbtn == 'nottakeit') $btn = 0;
                }

                $this->AddAction($request->action_date, $request->service_id, $id, $request->state, $pl_ID, $btn);
                $request->request->remove('service_id');
                $request->request->remove('state');
                $request->request->remove('action_date');
            }

            if(isset($request->actionbox) && isset($request->actionbtn)){
                $this->ChangeAction($request->actionbox,$request->actionbtn);
            }

            // add call
            if ($request->has('time') || $request->has('note') ){
                if($request->note != "" || $request->time != ""){
                    $this->AddCall($request->time, $request->note, $id, '3');
                }
            }

            $request->request->add(['admin_id_in_out' =>  Auth::user()->id]);
            
            Log::setLog('update','request',$id,"",$request->except(['_token']) );

            $data->update($request->except(['_token']));

            if($request->btn == "saveAndNew")
                return redirect()->route('admin.request.create.in',$id)->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.request.in')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.request.in')->with(['error'=>'يوجد خطء']);
        }
    }

    //  OUT 
    public function indexOut()
    {
        if(! Role::havePremission(['request_out']))
            return redirect()->route('admin.dashboard');

        $query = Requests::selection()->where('type',2)->where('status_cc',4);
        if(empty($_GET)){
            $_GET['state'] = 1;
        }
        // State
        if(isset($_GET['state']) && $_GET['state'] != "")
            if($_GET['state'] < 8 && $_GET['state'] > 0 && $_GET['state'] != 3)
                $query = $query->where('status_in_out',$_GET['state']);
        
        $requests = $query->paginate(PAGINATION_COUNT);
        return view('admin.request.indexout', compact('requests'));
    }

    public function createOut($req)
    {
        if(! Role::havePremission(['request_out']))
            return redirect()->route('admin.dashboard');

        $myorder = Requests::select()->find($req);
        if (!isset($myorder->id)) {
            return redirect()->route('admin.request.out')->with(['error' => '  غير موجوده']);
        }
        $opds = Admin::select()->where('permission', Auth::user()->permission )->get();
        $doctors = User::select('users.id','users.username','doctor_info.degree')->doctor()->Verification()->
                        leftJoin('doctor_info', 'users.id', '=', 'doctor_info.user_id')->get();
        $nurses = User::select()->nurse()->get();
        $drivers = User::select()->driver()->get();
        $serves = Service::select()->active()->notlab()->get();
        $specialtys = Specialty::select()->active()->get();
        $users = User::select()->get();
        $physicians = Physician::select()->get();
        $governorates = Governorate::select()->get();
        $companys = CompanyInfo::select()->get();
        $referrals = Referral::getAllReferral();
        $calls = RequestCall::select()->where('request_id',$req)->get();
        $actions = RequestAction::select()->where('request_id',$req)->get();
        $medicalTypes = MedicalType::select()->get();
        $usersReferrals= [];
        if(isset($myorder->user_id)){
            $usersReferrals = UsersReferral::getReferral($myorder->user_id);
        }
        
        return view('admin.request.createout',compact('users','medicalTypes','usersReferrals','actions','opds','drivers','companys','referrals','calls','governorates','physicians','specialtys','serves','myorder','doctors','nurses'));
    }

    public function updateOut(Request $request, $id)
    {
        if(! Role::havePremission(['request_out']))
            return redirect()->route('admin.dashboard');
      
            // dd($request->Feedback);
        try {
            $data = Requests::find($id);
            if (!$data) {
                return redirect()->route('admin.request.create.out')->with(['error' => '  غير موجوده']);
            }

            // opd
            if($data->opd_admin_id == null)
                $request->request->add(['opd_admin_id' =>  Auth::user()->id]);

            if($request->btn == "done"){
                $request->request->add(['status_in_out' => 4]);
                $request->request->add(['date_out' => date("Y-m-d")]);
            }elseif($request->btn == "hold")
                $request->request->add(['status_in_out' => 2]);
            elseif($request->btn == "cancel")
                $request->request->add(['status_in_out' => 5]);
            elseif($request->btn == "follow")
                $request->request->add(['status_in_out' => 7]);
                
            if (!$request->has('pay_or_not'))
                $request->request->add(['pay_or_not' => 0]);
            if (!$request->has('whatapp'))
                $request->request->add(['whatapp' => 0]);
            if (!$request->has('whatapp2'))
                $request->request->add(['whatapp2' => 0]);

            // PriceList 
            if( isset($request->medical_type_id) || isset($request->corporate_id) ){
                $pl_ID = PriceList::getPriceList($request->medical_type_id,$request->corporate_id);
            }else{
                $pl_ID = null;
            }
            $request->request->add(['price_list_id' =>  $pl_ID ]);
            
            // Action
            if(isset($request->service_id)){
                $btn = null;
                if(isset($request->actionbtn)){
                    if($request->actionbtn == 'takeit') $btn = 1;
                    if($request->actionbtn == 'nottakeit') $btn = 0;
                }

                $this->AddAction($request->action_date, $request->service_id, $id, $request->state, $pl_ID, $btn);
                $request->request->remove('service_id');
                $request->request->remove('state');
                $request->request->remove('action_date');
            }

            if(isset($request->actionbox) && isset($request->actionbtn)){
                $this->ChangeAction($request->actionbox,$request->actionbtn);
            }
            
            // Add Physician
            if (!$request->has('physician') || $request->physician == null ){
                if ( $request->has('physician_new')){
                    $phyID = $this->AddPhysician( $request->physician_new );
                    $request->request->add(['physician' => $phyID ]);
                }
            }

            // add call
            if ($request->has('time') || $request->has('note') ){
                if($request->note != "" || $request->time != ""){
                    $this->AddCall($request->time, $request->note, $id, '2');
                }
            }

            $request->request->add(['admin_id_in_out' =>  Auth::user()->id]);

            Log::setLog('update','request',$id,"",$request->except(['_token']) );

            $data->update($request->except(['_token']));

            if($request->btn == "saveAndNew" || isset($request->actionbtn))
                return redirect()->route('admin.request.create.out',$id)->with(['success'=>'تم الحفظ']);


            return redirect()->route('admin.request.out')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.request.out')->with(['error'=>'يوجد خطء']);
        }
    }

    //  LAB 
    public function indexLab()
    {
        if(! Role::havePremission(['request_lab']))
            return redirect()->route('admin.dashboard');
        
        $query = Requests::selection()->where('type',4)->where('status_cc',4);
        if(empty($_GET)){
            $_GET['state'] = 1;
        }
        // State
        if(isset($_GET['state']) && $_GET['state'] != "")
            if($_GET['state'] < 8 && $_GET['state'] > 0 && $_GET['state'] != 3)
                $query = $query->where('status_in_out',$_GET['state']);
        
        $requests = $query->paginate(PAGINATION_COUNT);
        return view('admin.request.indexlab', compact('requests'));
    }

    public function createLab($req)
    {
        if(! Role::havePremission(['request_lab']))
            return redirect()->route('admin.dashboard');

        $myorder = Requests::select()->find($req);
        if (!isset($myorder->id)) {
            return redirect()->route('admin.request.lab')->with(['error' => '  غير موجوده']);
        }
        $opds = Admin::select()->where('permission', Auth::user()->permission )->get();
        $doctors = User::select('users.id','users.username','doctor_info.degree')->doctor()->Verification()->
                        leftJoin('doctor_info', 'users.id', '=', 'doctor_info.user_id')->get();
        $nurses = User::select()->nurse()->get();
        $drivers = User::select()->driver()->get();
        $serves = Service::select()->active()->lab()->get();
        $specialtys = Specialty::select()->active()->get();
        $users = User::select()->get();
        $physicians = Physician::select()->get();
        $governorates = Governorate::select()->get();
        $companys = CompanyInfo::select()->get();
        $referrals = Referral::getAllReferral();
        $calls = RequestCall::select()->where('request_id',$req)->get();
        $actions = RequestAction::select()->where('request_id',$req)->get();
        $medicalTypes = MedicalType::select()->get();
        $usersReferrals= [];
        if(isset($myorder->user_id)){
            $usersReferrals = UsersReferral::getReferral($myorder->user_id);
        }
        
        return view('admin.request.createlab',compact('users','medicalTypes','usersReferrals','actions','opds','drivers','companys','referrals','calls','governorates','physicians','specialtys','serves','myorder','doctors','nurses'));
    }

    public function updateLab(Request $request, $id)
    {
        if(! Role::havePremission(['request_lab']))
            return redirect()->route('admin.dashboard');
      
        try {
            $data = Requests::find($id);
            if (!$data) {
                return redirect()->route('admin.request.create.lab')->with(['error' => '  غير موجوده']);
            }

            // opd
            if($data->opd_admin_id == null)
                $request->request->add(['opd_admin_id' =>  Auth::user()->id]);

            if($request->btn == "done"){
                $request->request->add(['status_in_out' => 4]);
                $request->request->add(['date_out' => date("Y-m-d")]);
            }elseif($request->btn == "hold")
                $request->request->add(['status_in_out' => 2]);
            elseif($request->btn == "cancel")
                $request->request->add(['status_in_out' => 5]);
            // elseif($request->btn == "approve")
            //     $request->request->add(['status_in_out' => 6]);
            elseif($request->btn == "follow")
                $request->request->add(['status_in_out' => 7]);

            if (!$request->has('covid19'))
                $request->request->add(['covid19' => 0]);
            if (!$request->has('pay_or_not'))
                $request->request->add(['pay_or_not' => 0]);
            if (!$request->has('whatapp'))
                $request->request->add(['whatapp' => 0]);
            if (!$request->has('whatapp2'))
                $request->request->add(['whatapp2' => 0]);

            // PriceList 
            if( isset($request->medical_type_id) || isset($request->corporate_id) ){
                $pl_ID = PriceList::getPriceList($request->medical_type_id,$request->corporate_id);
            }else{
                $pl_ID = null;
            }
            $request->request->add(['price_list_id' =>  $pl_ID ]);
            
            // Action
            if(isset($request->service_id)){
                $btn = null;
                if(isset($request->actionbtn)){
                    if($request->actionbtn == 'takeit') $btn = 1;
                    if($request->actionbtn == 'nottakeit') $btn = 0;
                }

                $this->AddAction($request->action_date, $request->service_id, $id, $request->state, $pl_ID, $btn);
                $request->request->remove('service_id');
                $request->request->remove('state');
                $request->request->remove('action_date');
            }

            if(isset($request->actionbox) && isset($request->actionbtn)){
                $this->ChangeAction($request->actionbox,$request->actionbtn);
            }

            // add call
            if ($request->has('time') || $request->has('note') ){
                if($request->note != "" || $request->time != ""){
                    $this->AddCall($request->time, $request->note, $id, '2');
                }
            }

            $request->request->add(['admin_id_in_out' =>  Auth::user()->id]);

            Log::setLog('update','request',$id,"",$request->except(['_token']) );

            $data->update($request->except(['_token']));

            if($request->btn == "saveAndNew" || isset($request->actionbtn))
                return redirect()->route('admin.request.create.lab',$id)->with(['success'=>'تم الحفظ']);


            return redirect()->route('admin.request.lab')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.request.lab')->with(['error'=>'يوجد خطء']);
        }
    }
 
    //

    private function AddUser($name, $phone)
    {
        $user = new User([
            'username' => $name,
            'phone' => $phone,
            'type' => '1',
            'quick' => "1",
            'password' => Hash::make(rand(1000000000,9999999999)),
        ]);
        $user->save();
        Log::setLog('create','users',$user->id,"","");
        return $user->id;
    }

    private function AddPhysician($name)
    {
        if ($name !=""){
            $phy = new Physician();
            $phy->name = $name;
            $phy->admin_id = Auth::user()->id;
            $phy->save();
            Log::setLog('create','physician',$phy->id,"","");
            return $phy->id;
        }
        return null;
    }

    public function AddCall($time, $note, $id, $depart)
    {
        $call = new RequestCall();
        if ($time){
            $call->call_time = $time;
        }
        if ($note){
            $call->note = $note;
        }
        $call->request_id = $id;
        $call->department = $depart;
        $call->admin_id  = Auth::user()->id;
        $call->save();
        Log::setLog('create','request_call',$call->id,"","");
    }

    public function destroyCall($id)
    {
        if(! Role::havePremission(['request_all','request_emergency','request_out','request_in']))
            return redirect()->route('admin.dashboard');

        try {
            $data = RequestCall::find($id);
            if (!$data) {
                return redirect()->route('admin.dashboard')->with(['error' => '  غير موجوده']);
            }
            Log::setLog('delete','request_call',$id,"","");
            $data->delete();

            return redirect()->back()->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function AddAction($date, $serv, $reqid, $state, $pl_ID, $btn = null)
    {
        $action = new RequestAction();
        if (isset($date)){
            $action->action_date = $date;
        }else
            $action->action_date = date("Y-m-d");
        if (isset($btn)){
            $action->state = $btn;
        }else
            $action->state = $state;
        $action->request_id = $reqid;
        $action->service_id = $serv;
        $action->price = Service::getPrice($pl_ID, $serv);
        
        $action->admin_id  = Auth::user()->id;
        $action->save();
        Log::setLog('create','request_action',$action->id,"","");
    }

    public function ChangeAction($data, $btn)
    {
        foreach($data as $id){
            if($btn == "delete") $this->destroyAction($id);
            elseif($btn == "takeit") $this->updateStateAction($id,'1');
            elseif($btn == "nottakeit") $this->updateStateAction($id,'0');
        }
        return redirect()->back();
    }

    public function updateStateAction($id,$val)
    {
        if(! Role::havePremission(['request_all','request_emergency','request_out','request_in']))
            return redirect()->route('admin.dashboard');

        try {
            $data = RequestAction::find($id);
            if (!$data) {
                return redirect()->route('admin.dashboard')->with(['error' => '  غير موجوده']);
            }
            $logID = Log::setLog('update','request_action',$id,"","");
            Log::setLogInfo($data->state, $val, $logID,"");
            $data->update(['state'=> $val]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroyAction($id)
    {
        if(! Role::havePremission(['request_all','request_emergency','request_out','request_in']))
            return redirect()->route('admin.dashboard');

        try {
            $data = RequestAction::find($id);
            if (!$data) {
                return redirect()->route('admin.dashboard')->with(['error' => '  غير موجوده']);
            }
            Log::setLog('delete','request_action',$id,"","");
            $data->delete();

            return redirect()->back()->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function storeSheet($id, Request $request){
        if(! Role::havePremission(['request_in']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'shift_date'=>"required",
            'nurse_id'=>"required",
            'shift_type'=>"required",
            // 'issues'=>"required",
        ]);
        
        try {
            $sheet = new NurseSheet();
            $sheet->nurse_id = $request->nurse_id;
            $sheet->shift_date = $request->shift_date;
            $sheet->issues = $request->issues;
            $sheet->shift_type = $request->shift_type;
            $sheet->admin_id  = Auth::user()->id;
            $sheet->request_id  = $id;
            $sheet->save();

            Log::setLog('create','nurse_sheet',$sheet->id,"","");

            return redirect()->route('admin.request.create.in', $id)->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroySheet($id){
        if(! Role::havePremission(['request_in']))
            return redirect()->route('admin.dashboard');

        try {
            $data = NurseSheet::find($id);
            if (!$data) {
                return redirect()->route('admin.dashboard')->with(['error' => '  غير موجوده']);
            }
            Log::setLog('delete','nurse_sheet',$id,"","");
            $data->delete();

            return redirect()->back()->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.dashboard')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // JSON
    public function getUserInfo($id = 0){
        // get records from database
        if($id!=0){
            $arr = User::select('username','address','phone','mobile','gender','code_zone_patient_id','governorate_id','city_id',
                                'land_mark','floor','apartment','whatapp','whatapp2','birth_date','fname')->find($id);
            $arr->fname = UsersReferral::getReferral($id);
        }else{
            $arr['price'] = 0;
        }
        echo json_encode($arr);
        exit;
    }

    public function getServPric(Request $request){
        // get records from database
        if(isset($request->service_id)){
            if( $request->price_list_id == 0 && ( isset($request->medical_type_id) || isset($request->corporate_id) ) ){
                $request->price_list_id = PriceList::getPriceList($request->medical_type_id,$request->corporate_id);
            }
            $arr['price'] = Service::getPrice($request->price_list_id, $request->service_id);
        }else{
            $arr['price'] = 0;
        }
        
        echo json_encode($arr);
        exit;
    }

    public function getPackagePrice(Request $request){
        // get records from database
        if(isset($request->price_list_id) && isset($request->package_id)){
            $arr['price'] = Package::getPrice($request->price_list_id, $request->package_id);
        }else{
            $arr['price'] = 0;
        }
        echo json_encode($arr);
        exit;
    }

    public function getCityGevern($id = 0){
        // get records from database
        if($id!=0){
            $arr = City::select('id','city_name_ar')->where('governorate_id',$id)->get();
        }else{
            $arr['price'] = 0;
        }
        echo json_encode($arr);
        exit;
    }

    public function requestMail(Request $request,$depart ="")  // Request Mail
    {
        try {
            // Check mail
            $mailTo ="it@care-hub.net";
            $setting = Setting::select()->where('name', $depart)->first();
            if(isset($setting->value)){
                $testMail = $setting->value ;
                if (strpos($testMail, '@') !== false) {
                    $mailTo = $setting->value ;
                }
            } 
            Mail::To($mailTo)->send(new requestMail($request->post()));
            return response()->json([ 'data'=>['success' => "1"] ]);
        } catch (\Exception $ex) {
            return response()->json([ 'data'=>['success' => "0", 'error' => "Email Error"] ]);
        }
    }

    // public function getCountReqest($type = 0){
    //     // get records from database
    //     $arr['count'] = Requests::where('type',$type)->count();
    //     echo json_encode($arr);
    //     exit;
    // }

}
