<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\ReferalCat;
use App\Models\Referral;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['referral_view','referral_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Referral::select()->paginate(PAGINATION_COUNT);
        return view('admin.referral.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['referral_cr']))
            return redirect()->route('admin.dashboard');

        $cats = ReferalCat::select()->get();
        return view('admin.referral.create',compact('cats'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['referral_cr']))
            return redirect()->route('admin.dashboard');
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $ref = Referral::create($request->except(['_token']));
            Log::setLog('create','referral',$ref->id,"","");
            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.referral.create')->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.referral')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.referral.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['referral_view','referral_idt']))
            return redirect()->route('admin.dashboard');

        $cats = ReferalCat::select()->get();
        $datas = Referral::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.referral')->with(['error'=>"غير موجود"]);
        }
        return view('admin.referral.edit',compact('datas','cats'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['referral_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Referral::find($id);
            if (!$data) {
                return redirect()->route('admin.referral.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            Log::setLog('update','referral',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));
            return redirect()->route('admin.referral')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.referral')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function refCat()
    {
        if(! Role::havePremission(['referral_cat']))
            return redirect()->route('admin.dashboard');

        $cats = ReferalCat::select()->paginate(PAGINATION_COUNT);
        return view('admin.referral.indexcat', compact('cats'));
    }

    public function refCatStore(Request $request)
    {
        if(! Role::havePremission(['referral_cat']))
            return redirect()->route('admin.dashboard');
        try {
            
            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $ref = ReferalCat::create($request->except(['_token']));
            Log::setLog('create','referal_cat',$ref->id,"","");

            return redirect()->route('admin.referral.cat')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.referral.cat')->with(['error'=>'يوجد خطء']);
        }
    }

    public function refCatDelete($id)
    {
        if(! Role::havePremission(['referral_cat_del']))
            return redirect()->route('admin.dashboard');
        try {
            $data = ReferalCat::find($id);
            if (!$data) {
                return redirect()->route('admin.referral.cat', $id)->with(['error' => '  غير موجوده']);
            }
            Log::setLog('Delete','referal_cat',$id,$data->name,"");
            $data->delete();

            return redirect()->route('admin.referral.cat')->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.referral.cat')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
