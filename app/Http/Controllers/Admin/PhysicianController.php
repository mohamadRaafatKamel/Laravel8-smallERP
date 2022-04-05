<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Physician;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhysicianController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['physician_view','physician_idt']))
            return redirect()->route('admin.dashboard');
        $datas = Physician::select()->paginate(PAGINATION_COUNT);
        return view('admin.physician.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['physician_cr']))
            return redirect()->route('admin.dashboard');
        return view('admin.physician.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['physician_cr']))
            return redirect()->route('admin.dashboard');
        try {
            $request->request->add(['admin_id' =>  Auth::user()->id ]);

            $phy = Physician::create($request->except(['_token']));
            Log::setLog('create','physician',$phy->id,"","");
            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.physician.create')->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.physician')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.physician.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['physician_view','physician_idt']))
            return redirect()->route('admin.dashboard');
        $datas = Physician::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.physician')->with(['error'=>"غير موجود"]);
        }
        return view('admin.physician.edit',compact('datas'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['physician_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Physician::find($id);
            if (!$data) {
                return redirect()->route('admin.physician.edit', $id)->with(['error' => '  غير موجوده']);
            }

            Log::setLog('update','physician',$id,"",$request->except(['_token']) );

            $data->update($request->except(['_token']));

            return redirect()->route('admin.physician')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.physician')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

}
