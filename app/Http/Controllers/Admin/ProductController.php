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

    public function destroyProductBuy($prid, $id)
    {
        try {
            $data = ProductBuy::find($id);
            if (!$data) {
                return redirect()->route('admin.product', $id)->with(['error' => '  غير موجوده']);
            }
            // Log::setLog('delete','price_list_info',$data->id,"","");
            $data->update(['status'=> '99']);

            return redirect()->route('admin.product.edit',$prid)->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.product.edit',$prid)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
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

            // $saveID = 0;
            // if(isset($request->service_id) && isset($request->price_list_id)){
            //     $data = PriceListInfo::select()->where('service_id',$request->service_id)->where('price_list_id',$request->price_list_id)->first();
            //     if(isset($data->id)){
            //         $saveID = $data->id;
            //         Log::setLog('update','price_list_info',$data->id,"",$request->except(['_token']) );
            //         $data->update(['price'=> $request->price]);
            //     }else{
                    
            //     }
            // }elseif(isset($request->package_id) && isset($request->price_list_id)){
            //     $data = PriceListInfo::select()->where('package_id',$request->package_id)->where('price_list_id',$request->price_list_id)->first();
            //     if(isset($data->id)){
            //         $saveID = $data->id;
            //         Log::setLog('update','price_list_info',$data->id,"",$request->except(['_token']) );
            //         $data->update(['price'=> $request->price]);
            //     }else{
            //         $request->request->add(['admin_id' =>  Auth::user()->id ]);
            //         $PL= PriceListInfo::create($request->except(['_token']));
            //         Log::setLog('create','price_list_info',$PL->id,"","");
            //         $saveID = $PL->id;
            //     }
            // }
            return response()->json(['success'=>'Added','proid'=>$saveID],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
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