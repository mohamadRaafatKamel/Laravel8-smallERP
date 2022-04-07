<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Role;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['supplier_view','supplier_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Supplier::select()->paginate(PAGINATION_COUNT);
        return view('admin.supplier.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['supplier_cr']))
            return redirect()->route('admin.dashboard');

        return view('admin.supplier.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['supplier_cr']))
            return redirect()->route('admin.dashboard');

        
        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= Supplier::create($request->except(['_token']));
            // Log::setLog('create','supplier',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.supplier.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.supplier')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.supplier.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['supplier_view','supplier_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Supplier::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.supplier')->with(['error'=>"غير موجود"]);
        }
        return view('admin.supplier.edit',compact('datas'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['supplier_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Supplier::find($id);
            if (!$data) {
                return redirect()->route('admin.supplier.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            // Log::setLog('update','supplier',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.supplier')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.supplier')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = Supplier::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.supplier', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.supplier')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.supplier')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
