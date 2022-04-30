<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['customer_view','customer_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Customer::select()->paginate(PAGINATION_COUNT);
        return view('admin.customer.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['customer_cr']))
            return redirect()->route('admin.dashboard');

        return view('admin.customer.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['customer_cr']))
            return redirect()->route('admin.dashboard');

        
        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= Customer::create($request->except(['_token']));
            // Log::setLog('create','customer',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.customer.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.customer')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.customer.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['customer_view','customer_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Customer::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.customer')->with(['error'=>"غير موجود"]);
        }
        return view('admin.customer.edit',compact('datas'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['customer_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Customer::find($id);
            if (!$data) {
                return redirect()->route('admin.customer.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            // Log::setLog('update','customer',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.customer')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.customer')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = customer::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.customer', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.customer')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.customer')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
