<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Log;
use App\Models\Role;
use App\Models\RoleInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['role_view','role_idt']))
            return redirect()->route('admin.dashboard');

        $promos = Role::select()->paginate(PAGINATION_COUNT);
        return view('admin.role.index', compact('promos'));
    }

    public function create()
    {
        if(! Role::havePremission(['role_cr']))
            return redirect()->route('admin.dashboard');

        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['role_cr']))
            return redirect()->route('admin.dashboard');

        try {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
            $logID = Log::setLog('create','role',$role->id,"","");

            if($request->role_info){
                if(count($request->role_info)>0){
                    foreach ($request->role_info as $info){
                        $rroollee = new RoleInfo();
                        $rroollee->role_id = $role->id;
                        $rroollee->name = $info;
                        $rroollee->have_permission = '1';
                        $rroollee->admin_id = Auth::user()->id;
                        $rroollee->save();
                        
                        Log::setLogInfo('',$info,$logID,"create Role Info");
                    }
                }
            }

//            Role::create($request->except(['_token']));
            return redirect()->route('admin.role')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.role.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['role_view','role_idt']))
        return redirect()->route('admin.dashboard');

        $role = Role::select()->find($id);
        if(!$role){
            return redirect()->route('admin.role')->with(['error'=>"غير موجود"]);
        }
        $roleInfo = RoleInfo::select()->where('role_id',$role->id)->get();
        $myRoleInfo = [];
        if(!$roleInfo->isEmpty()){
            foreach ($roleInfo as $rinfo){
                $myRoleInfo[$rinfo->name] = $rinfo->have_permission;
            }
        }
        return view('admin.role.edit',compact('role','myRoleInfo'));
    }

    public function update($id,Request $request)
    {
        if(! Role::havePremission(['role_idt']))
            return redirect()->route('admin.dashboard');

        try {

            $role = Role::select()->find($id);
            if (!$role) {
                return redirect()->route('admin.role.edit', $id)->with(['error' => '  غير موجوده']);
            }
            $roleInfo = RoleInfo::select()->where('role_id',$role->id)->delete();

            // update name
            $logID = Log::setLog('update','role',$role->id,"","");
            $role->update($request->except('_token'));

            if($request->role_info){
                if(count($request->role_info)>0){
                    foreach ($request->role_info as $info){
                        $rroollee = new RoleInfo();
                        $rroollee->role_id = $role->id;
                        $rroollee->name = $info;
                        $rroollee->have_permission = '1';
                        $rroollee->admin_id = Auth::user()->id;
                        $rroollee->save();

                        Log::setLogInfo('',$info,$logID,"update Role Info");
                    }
                }
            }

            return redirect()->route('admin.role')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.role')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

//    public function destroy($id)
//    {
//
//        try {
//            $promos = Role::find($id);
//            if (!$promos) {
//                return redirect()->route('admin.role', $id)->with(['error' => '  غير موجوده']);
//            }
//            $promos->delete();
//
//            return redirect()->route('admin.role')->with(['success' => 'تم حذف  بنجاح']);
//
//        } catch (\Exception $ex) {
//            return redirect()->route('admin.role')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
//        }
//    }
}
