<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Requests;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    static public function notificationShow() 
    {
        $arr = [
            'newCC'=>0,
            'newEM'=>0,
            'newIN'=>0,
            'newOUT'=>0
        ];
        if(Role::havePremission(['request_all'])){
            $newCC = Requests::where('status_cc','=',1)->where('type','!=',1)->count();
            $arr['newCC'] = $newCC;
        }
        if(Role::havePremission(['request_emergency'])){
            $newEM = Requests::where('status_cc','=',1)->where('type','=',1)->count();
            $arr['newEM'] = $newEM;
        }
        if(Role::havePremission(['request_out'])){
            $newOUT = Requests::where('status_cc',4)->where('status_in_out','=',1)->where('type',2)->count();
            $arr['newOUT'] = $newOUT;
        }
        if(Role::havePremission(['request_in'])){
            $newIN = Requests::where('status_cc',4)->where('status_in_out','=',1)->where('type',3)->count();
            $arr['newIN'] = $newIN;
        }
        echo json_encode($arr);
        exit;

    }

    // public function saveToken(Request $request)
    // {
    //     auth()->user()->update(['device_token'=>$request->token]);
    //     return response()->json(['token saved successfully.']);
    // }

    // public function sendNotification(Request $request)
    // {
    //     $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

    //     $SERVER_API_KEY = 'AAAAghN6yis:APA91bHzgc_2obeuRyrM4tVtZaP5-0Bq96w4MhjQanAP8tAD6soRWU85NS8BxbcBjXFQ10pVWjDHXPn8yhoRZ26UUzLebwoAXSYyV3pP_fV-gSOv9OK1BBl-ppPvgRzDOqY0o0vDWh6h';

    //     $data = [
    //         "registration_ids" => $firebaseToken,
    //         "notification" => [
    //             "title" => $request->title,
    //             "body" => $request->body,
    //             "content_available" => true,
    //             "priority" => "high",
    //         ]
    //     ];
    //     $dataString = json_encode($data);

    //     $headers = [
    //         'Authorization: key=' . $SERVER_API_KEY,
    //         'Content-Type: application/json',
    //     ];

    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    //     $response = curl_exec($ch);

    //     dd($response);
    // }


}
