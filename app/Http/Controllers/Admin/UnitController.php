<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Role;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UnitController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['unit_view','unit_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Unit::select()->paginate(PAGINATION_COUNT);
        return view('admin.unit.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['unit_cr']))
            return redirect()->route('admin.dashboard');

        $generals = Unit::selection()->active()->get();
        return view('admin.unit.create',compact('generals'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['unit_cr']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'name'=>"unique:units,name",
        ]);
        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= Unit::create($request->except(['_token']));
            // Log::setLog('create','unit',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.unit.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.unit')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.unit.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['unit_view','unit_idt']))
            return redirect()->route('admin.dashboard');
        $generals = Unit::select()->active()->where('id','!=',$id)->get();
        $datas = Unit::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.unit')->with(['error'=>"غير موجود"]);
        }
        return view('admin.unit.edit',compact('datas','generals'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['unit_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Unit::find($id);
            if (!$data) {
                return redirect()->route('admin.unit.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            // Log::setLog('update','unit',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.unit')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.unit')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = Unit::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.unit', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.unit')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.unit')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
