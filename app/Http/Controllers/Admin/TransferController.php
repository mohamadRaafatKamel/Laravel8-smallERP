<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Role;
use App\Models\TransferComp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['transfer_view','transfer_idt']))
            return redirect()->route('admin.dashboard');

        $datas = TransferComp::select()->paginate(PAGINATION_COUNT);
        return view('admin.transfer.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['transfer_cr']))
            return redirect()->route('admin.dashboard');

        return view('admin.transfer.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['transfer_cr']))
            return redirect()->route('admin.dashboard');

        
        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= TransferComp::create($request->except(['_token']));
            // Log::setLog('create','transfer',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.transfer.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.transfer')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.transfer.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['transfer_view','transfer_idt']))
            return redirect()->route('admin.dashboard');

        $datas = TransferComp::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.transfer')->with(['error'=>"غير موجود"]);
        }
        return view('admin.transfer.edit',compact('datas'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['transfer_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = TransferComp::find($id);
            if (!$data) {
                return redirect()->route('admin.transfer.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            // Log::setLog('update','transfer',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.transfer')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.transfer')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = transfer::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.transfer', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.transfer')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.transfer')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
