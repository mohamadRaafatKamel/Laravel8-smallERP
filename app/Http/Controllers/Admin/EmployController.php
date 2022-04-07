<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employ;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['employ_view','employ_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Employ::select()->paginate(PAGINATION_COUNT);
        return view('admin.employ.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['employ_cr']))
            return redirect()->route('admin.dashboard');

        return view('admin.employ.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['employ_cr']))
            return redirect()->route('admin.dashboard');

        
        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= Employ::create($request->except(['_token']));
            // Log::setLog('create','employ',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.employ.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.employ')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.employ.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['employ_view','employ_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Employ::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.employ')->with(['error'=>"غير موجود"]);
        }
        return view('admin.employ.edit',compact('datas'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['employ_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Employ::find($id);
            if (!$data) {
                return redirect()->route('admin.employ.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            // Log::setLog('update','employ',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.employ')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.employ')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = employ::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.employ', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.employ')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.employ')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
