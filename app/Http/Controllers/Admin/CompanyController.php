<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Models\Log;
use App\Models\PriceList;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['company_view','company_idt']))
            return redirect()->route('admin.dashboard');
        $datas = CompanyInfo::select()->paginate(PAGINATION_COUNT);
        return view('admin.company.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['company_cr']))
            return redirect()->route('admin.dashboard');
        $priceLists = PriceList::selection()->get();
        return view('admin.company.create',compact('priceLists'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['company_cr']))
            return redirect()->route('admin.dashboard');
        try {
            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            
            // dd($request->post());
            $comp = CompanyInfo::create($request->except(['_token']));
            Log::setLog('create','company_info',$comp->id,"","");
            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.company.create')->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.company')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.company.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['company_view','company_idt']))
            return redirect()->route('admin.dashboard');
        $datas = CompanyInfo::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.company')->with(['error'=>"غير موجود"]);
        }
        $priceLists = PriceList::selection()->get();
        return view('admin.company.edit',compact('datas','priceLists'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['company_idt']))
            return redirect()->route('admin.dashboard');
        try {
            $data = CompanyInfo::find($id);
            if (!$data) {
                return redirect()->route('admin.company.edit', $id)->with(['error' => '  غير موجوده']);
            }
            Log::setLog('update','company_info',$id,"",$request->except(['_token']) );

            $data->update($request->except(['_token']));
            return redirect()->route('admin.company')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.company')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {
    //     try {
    //         $data = CompanyInfo::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.company', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();
    //         return redirect()->route('admin.company')->with(['success' => 'تم حذف  بنجاح']);
    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.company')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
