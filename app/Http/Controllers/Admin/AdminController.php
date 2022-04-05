<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Emarh;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['admin_view','admin_idt']))
            return redirect()->route('admin.dashboard');

        $admins = Admin::select()->paginate(PAGINATION_COUNT);
        return view('admin.admin.index', compact('admins'));
    }

    public function create()
    {
        if(! Role::havePremission(['admin_cr']))
            return redirect()->route('admin.dashboard');

        $roles = Role::select()->get();
        return view('admin.admin.create',compact('roles'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['admin_cr']))
            return redirect()->route('admin.dashboard');

        try {
            $pass = Hash::make($request->password);
            unset($request->password);
            $adm = Admin::create(array_merge($request->except(['_token']),['password'=>$pass,'remember_token'=>'']));
            Log::setLog('create','admin',$adm->id,"","");
            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.admin.create')->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.admin')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.admin.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['admin_view','admin_idt']))
            return redirect()->route('admin.dashboard');

        $roles = Role::select()->get();
        $admins = Admin::select()->find($id);
        if(!$admins){
            return redirect()->route('admin.admin')->with(['error'=>"غير موجود"]);
        }
        return view('admin.admin.edit',compact('admins','roles'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['admin_idt']))
            return redirect()->route('admin.dashboard');

        try {

            $admins = Admin::find($id);
            if (!$admins) {
                return redirect()->route('admin.admin.edit', $id)->with(['error' => '  غير موجوده']);
            }
            $logID = Log::setLog('create','admin',$admins->id,"","");
            if(isset($request->password)){
                $pass = Hash::make($request->password);
                unset($request->password);
                $admins->update(['password'=>$pass]);
                Log::setLogInfo($admins->password,$pass,$logID,"");
            }

            if(isset($request->permission)){
                $admins->update(['permission'=>$request->permission]);
                Log::setLogInfo($admins->permission,$request->permission,$logID,"");
            }

            if(isset($request->name)){
                $admins->update(['name'=>$request->name]);
                Log::setLogInfo($admins->name,$request->name,$logID,"");
            }

            if(isset($request->email)){
                $admins->update(['email'=>$request->email]);
                Log::setLogInfo($admins->email,$request->email,$logID,"");
            }

            return redirect()->route('admin.admin')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.admin')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroy($id)
    {
        if(! Role::havePremission(['admin_view','admin_cr','admin_idt']))
            return redirect()->route('admin.dashboard');
        try {
            $admins = Admin::find($id);
            if (!$admins) {
                return redirect()->route('admin.admin', $id)->with(['error' => '  غير موجوده']);
            }
            Log::setLog('delete','admin',$admins->id,"","");
            $admins->delete();

            return redirect()->route('admin.admin')->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.admin')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
