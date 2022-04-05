<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\CompanyInfo;
use App\Models\Country;
use App\Models\DoctorInfo;
use App\Models\DoctorWorkDay;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\Requests;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /*
    public function index()
    {
        // make doctor add his information if not added
        $notification = 0;
        if (Auth::user()) {
            if (Auth::user()->type == '2') {
                $doc = DoctorInfo::where('user_id', Auth::user()->id)->first();
                if (!isset($doc->id)) {
                    $notification = 1;
                }
            }
        }
        $slider = [];
        $allsliders = Setting::select()->where('name', 'LIKE', "sliderImage%")->get();
        foreach ($allsliders as $allslider) {
            $slider[$allslider->name] = $allslider->value;
        }
        $serves = Service::select()->active()->get();
        $specialtys = Specialty::select()->active()->get();
        return view('front.index', compact('specialtys', 'serves', 'slider', 'notification'));
    }

    public function callme(Request $request)
    {
        try {
            if (isset($request->need)) {
                if ($request->need == "callme") {
                    $req = new Requests();
                    if (Auth::check()) {
                        $req->user_id = Auth::user()->id;
                    }
                    $req->phone = $request->phone;
                    $req->specialty_id = $request->specialty_id;
                    $req->emergency = '1';
                    $req->call_him = '0';
                    $req->type = '1';
                    $req->save();
                } elseif ($request->need == "MedicalServices") {
                    $req = new Requests();
                    if (Auth::check()) {
                        $req->user_id = Auth::user()->id;
                    }
                    $req->phone = $request->phone;
                    $req->service_id = $request->service_id;
                    $req->visit_time_day = $request->visit_time_day;
                    $req->visit_time_from = $request->visit_time_from;
                    $req->visit_time_to = $request->visit_time_to;
                    $req->type = '2';
                    $req->save();
                } elseif ($request->need == "VisitServices") {
                    $req = new Requests();
                    if (Auth::check()) {
                        $req->user_id = Auth::user()->id;
                    }
                    $req->phone = $request->phone;
                    $req->specialty_id = $request->specialty_id;
                    $req->visit_time_day = $request->visit_time_day;
                    $req->visit_time_from = $request->visit_time_from;
                    $req->visit_time_to = $request->visit_time_to;
                    $req->type = '3';
                    $req->save();
                }
            }

            return redirect()->route('home', app()->getLocale())->with(['success' => 'تم الحفظ']);
        } catch (\Exception $ex) {
            return redirect()->route('home', app()->getLocale())->with(['error' => 'يوجد خطء']);
        }
    }

    public function userinfo()
    {
        $specialtis = Specialty::select()->get();
        $countrys = Country::select()->get();
        $governorates = Governorate::select()->get();
        $citys = City::select()->get();
        $id = Auth::user()->id;
        $user = User::select()->find($id);
        if (!$user) {
            return redirect()->route('home', app()->getLocale())->with(['error' => "غير موجود"]);
        }
        $id = Auth::user()->id;
        // get doctor data
        $doctor = DoctorInfo::select()->where('user_id', $id)->first();
        if (!isset($doctor->id)) {
            $doctor = DoctorInfo::select()->find(0);
        }
        // get partner data
        $partner = CompanyInfo::select()->where('user_id', $id)->first();
        if (!isset($partner->id)) {
            $partner = CompanyInfo::select()->find(0);
        }
        $specialtys = Specialty::select()->active()->get();
        // time work
        $timeWork = [];
        $docWorks = DoctorWorkDay::select()->where('user_id', Auth::user()->id)->get();
        foreach ($docWorks as $docWork) {
            $timeWork[$docWork->day] = 1;
            $timeWork[$docWork->day . 'f'] = $docWork->time_from;
            $timeWork[$docWork->day . 't'] = $docWork->time_to;
        }
        return view('front.userinfo', compact('user', 'specialtis', 'doctor', 'partner', 'countrys', 'governorates', 'citys', 'timeWork'));
    }


    public function userInfoUpdate(Request $request)
    {
        try {
            $id = Auth::user()->id;
            $user = User::select()->find($id);
            if (isset($request->btn)) {
                if ($request->btn == "GeneralInfo") {
                    $user->update($request->except('_token'));
                } else if ($request->btn == "Doctor") {
                    $mydoctor = $request->post();
                    if (isset($request->cv)) {
                        $image = $request->file('cv');
                        if ($image->extension() != "pdf")
                            return redirect()->route('admin.user.view', $id)->with(['error' => __("CV must be PDF file")]);
                        $imageName = "Dr" . $user->fname . $user->phone . "." . $image->extension();
                        $image->move(public_path('doctorcv'), $imageName);
                        $path = "public/doctorcv/" . $imageName;
                        $mydoctor['cv'] = $path;
                    }
                    if (isset($request->photo)) {
                        $image = $request->file('photo');
                        $imageName = "Dr" . $user->fname . $user->phone . "." . $image->extension();
                        $image->move(public_path('doctorphoto'), $imageName);
                        $path = "public/doctorphoto/" . $imageName;
                        $mydoctor['photo'] = $path;
                    }
//                    update or create doctor
//                    DoctorInfo::updateOrCreate
                    $doctor = DoctorInfo::select()->where('user_id', $id)->first();
                    if (isset($doctor->id)) {
                        $doctor->update($mydoctor);
                    } else {
                        $mydoctor['user_id'] = $id;
                        DoctorInfo::create($mydoctor);
                    }

                } else if ($request->btn == "partner") {
                    $myPartner = CompanyInfo::select()->where('user_id', $id)->first();
                    if (isset($myPartner->id)) {
                        $myPartner->update($request->except('_token'));
                    } else {
                        CompanyInfo::create(array_merge($request->except(['_token']), ['user_id' => $id]));
                    }
                } else if ($request->btn == "docWorkTime") {
                    DoctorWorkDay::where('user_id', Auth::user()->id)->delete();
                    $days = $request->day;
                    foreach ($days as $thisday) {
                        $dayFrom = $request->post(strtolower($thisday . 'f'));
                        $dayTo = $request->post(strtolower($thisday . 't'));
                        $docDay = new DoctorWorkDay();
                        $docDay->user_id = Auth::user()->id;
                        $docDay->day = $thisday;
                        $docDay->time_from = $dayFrom;
                        $docDay->time_to = $dayTo;
                        $docDay->save();
                    }

                }
            }


//            if(isset($request->permission)){
//                $pass = Hash::make($request->password);
//                unset($request->password);
//                $admins->update(['password'=>$pass]);
//            }
//
//            if(isset($request->name)){
//                $admins->update(['name'=>$request->name]);
//            }
//
//            if(isset($request->email)){
//                $admins->update(['email'=>$request->email]);
//            }

            return redirect()->route('home.user.info', app()->getLocale())->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('home.user.info', app()->getLocale())->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function userAllRequest()
    {
        $requests = Requests::select()->where('user_id', Auth::user()->id)->Where('state', '0')->get();
        $orders = Order::select()->where('user_id', Auth::user()->id)->get();
        return view('front.request', compact('requests', 'orders'));
    }

    public function userViewRequest($lang, $msg, $id)
    {
        if ($msg == "order") {
            $data = Order::select()->find($id);
            if (!isset($data->id)) {
                return redirect()->route('user.all.request', app()->getLocale());
            }
        } elseif ($msg == "request") {
            $data = Requests::select()->find($id);
            if (!isset($data->id)) {
                return redirect()->route('user.all.request', app()->getLocale());
            }
        } else {
            return redirect()->route('user.all.request', app()->getLocale());
        }
        return view('front.requestview', compact('data', 'msg'));
    }

    public function RequestState($lang, $id, $state)
    {
        $data = Requests::select()->find($id);
        if (!isset($data->id)) {
            return redirect()->route('user.all.request', app()->getLocale());
        }
        $data->update(['state'=>$state]);
        return redirect()->route('user.all.request', app()->getLocale());
    }

    public function DoctorRequest()
    {
        $orders = Order::select()->where('doctor_id', Auth::user()->id)->whereIn('states',['1','2','3'])->get();
        return view('front.docrequest', compact('orders'));
    }

    public function DocOrderState($lang, $id, $state)
    {
        $data = Order::select()->find($id);
        if (!isset($data->id)) {
            return redirect()->route('user.doc.request', app()->getLocale());
        }
        $data->update(['states'=>$state]);
        if($state == '29')
            return redirect()->route('user.doc.request', app()->getLocale());
        else
            return redirect()->route('user.view.request', ['language'=>app()->getLocale(),'msg'=>'order','id'=>$id]);
    }

//    public function lang($lang)
//    {
//        if(!isset($_COOKIE['lang'])){
//            setcookie('lang',$lang, time() + (86400 * 30 * 30), "/");
//        }
//
//        if (in_array($lang, ['en', 'ar'])) {
////            session()->put('lang',$lang);
//            $_COOKIE['lang'] = $lang;
//        }else{
//            $_COOKIE['lang'] = 'ar';
//        }
//        App::setLocale($_COOKIE['lang']);
//        return redirect()->route('home');
//    }

    static function ip_info_old($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
//    print_r( \App\Http\Controllers\Front\HomeController::ip_info("156.192.135.186", "Location") );
//    $clientIP = request()->ip();

    static function ip_info($purpose = null)
    {
        // IP address
        $userIP = '156.192.135.186';
        // $userIP = request()->ip();
        // API end URL
        $apiURL = 'https://freegeoip.app/json/' . $userIP;
        // Create a new cURL resource with URL
        $ch = curl_init($apiURL);
        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Execute API request
        $apiResponse = curl_exec($ch);
        // Close cURL resource
        curl_close($ch);
        // Retrieve IP data from API response
        $ipData = json_decode($apiResponse, true);

        if (!empty($ipData)) {
            switch ($purpose) {
                case "code":
                    $output = $ipData['country_code'];
                    break;
                case "cname":
                    $output = $ipData['country_name'];
                    break;
                case "rcode":
                    $output = $ipData['region_code'];
                    break;
                case "rname":
                    $output = $ipData['region_name'];
                    break;
                case "city":
                    $output = $ipData['city'];
                    break;
            }

            return $output;
//            print_r($ipData);
        } else {
//            echo 'IP data is not found!';
        }
    }
*/

}
