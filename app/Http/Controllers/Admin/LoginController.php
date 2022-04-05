<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\Log;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function getLogin()
    {
//        $aa = new Admin();
//        $aa->remember_token = '';
//        $aa->name = 'Admin';
//        $aa->email = 'admin@code-flex.com';
//        $aa->password = Hash::make("123456789");
//        $aa->save();
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request){

        $remember_me = $request->has('remember_me') ? true:false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            // Log::setLog('Login','admin',"","","");
            return redirect() -> route('admin.dashboard');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }

}
