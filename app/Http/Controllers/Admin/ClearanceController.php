<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClearanceComp;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClearanceController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['clearance_view','clearance_idt']))
            return redirect()->route('admin.dashboard');

        $datas = ClearanceComp::select()->paginate(PAGINATION_COUNT);
        return view('admin.clearance.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['clearance_cr']))
            return redirect()->route('admin.dashboard');

        return view('admin.clearance.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['clearance_cr']))
            return redirect()->route('admin.dashboard');

        
        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= ClearanceComp::create($request->except(['_token']));
            // Log::setLog('create','clearance',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.clearance.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.clearance')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.clearance.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['clearance_view','clearance_idt']))
            return redirect()->route('admin.dashboard');

        $datas = ClearanceComp::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.clearance')->with(['error'=>"غير موجود"]);
        }
        return view('admin.clearance.edit',compact('datas'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['clearance_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = ClearanceComp::find($id);
            if (!$data) {
                return redirect()->route('admin.clearance.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            // Log::setLog('update','clearance',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.clearance')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.clearance')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = clearance::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.clearance', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.clearance')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.clearance')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
