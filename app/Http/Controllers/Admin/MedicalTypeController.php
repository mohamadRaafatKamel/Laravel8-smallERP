<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Role;
use App\Models\MedicalType;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalTypeController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['medicaltype_view','medicaltype_idt']))
            return redirect()->route('admin.dashboard');
        
        $datas = MedicalType::select()->paginate(PAGINATION_COUNT);
        return view('admin.medicaltype.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['medicaltype_cr']))
            return redirect()->route('admin.dashboard');
        $priceLists = PriceList::selection()->get();
        return view('admin.medicaltype.create',compact('priceLists'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['medicaltype_cr']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'name_en'=>"unique:medical_type,name_en",
        ]);
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= MedicalType::create($request->except(['_token']));
            Log::setLog('create','medical_type',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.medicaltype.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.medicaltype')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.medicaltype.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['medicaltype_view','medicaltype_idt']))
            return redirect()->route('admin.dashboard');

        $priceLists = PriceList::selection()->get();
        $datas = MedicalType::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.medicaltype')->with(['error'=>"غير موجود"]);
        }
        return view('admin.medicaltype.edit',compact('datas','priceLists'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['medicaltype_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = MedicalType::find($id);
            if (!$data) {
                return redirect()->route('admin.medicaltype.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            Log::setLog('update','medical_type',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.medicaltype')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.medicaltype')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = MedicalType::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.medicaltype', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.medicaltype')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.medicaltype')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
