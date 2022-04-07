<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['product_view','product_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Product::select()->paginate(PAGINATION_COUNT);
        return view('admin.product.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['product_cr']))
            return redirect()->route('admin.dashboard');

        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['product_cr']))
            return redirect()->route('admin.dashboard');

        
        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= Product::create($request->except(['_token']));
            // Log::setLog('create','product',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.product.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.product')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.product.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['product_view','product_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Product::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.product')->with(['error'=>"غير موجود"]);
        }
        return view('admin.product.edit',compact('datas'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['product_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Product::find($id);
            if (!$data) {
                return redirect()->route('admin.product.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            // Log::setLog('update','product',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.product')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.product')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = product::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.product', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.product')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.product')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
