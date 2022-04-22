<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Product;
use App\Models\ProductBuy;
use App\Models\Role;
use App\Models\Unit;
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

            if (!$request->has('exp_have'))
                $request->request->add(['exp_have' => 0]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= Product::create($request->except(['_token']));
            // Log::setLog('create','product',$spc->id,"","");

            return redirect()->route('admin.product.edit',$spc->id)->with(['success'=>'تم الحفظ']);
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
        $units = Unit::selection()->active()->get();
        $prbuys = ProductBuy::selection()->active()->where('product_id',$id)->get();
    
        return view('admin.product.edit',compact('datas','units','prbuys'));
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

            if (!$request->has('exp_have'))
                $request->request->add(['exp_have' => 0]);

            // Log::setLog('update','product',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.product')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.product')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // AJAX

    public function setBuy(Request $request)
    {
        if(! Role::havePremission(['product_cr']))
            return "No Premission";

        try {

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $Pr= ProductBuy::create($request->except(['_token']));
            // Log::setLog('create','price_list_info',$PL->id,"","");
            $saveID = $Pr->id;
            return response()->json(['success'=>'Added','proid'=>$saveID],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
        }
    }

    public function destroyProductBuy(Request $request)
    {
        // if(! Role::havePremission(['request_all','request_emergency','request_out','request_in']))
        //     return redirect()->route('admin.dashboard');

        try {

            $data = ProductBuy::find($request->id);
            if (!$data) {
                return response()->json(['success'=>0],400);
            }
            // Log::setLog('delete','request_call', $request->id, "", "");
            // $data->delete();
            $data->update(['status'=> '99']);
            
            return response()->json(['success'=>1 ],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>0],400);
        }
    }

}
