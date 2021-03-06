<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClearanceComp;
use App\Models\Customer;
use App\Models\Log;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\OrderReceive;
use App\Models\OrderReceiveInfo;
use App\Models\Product;
use App\Models\ProductBuy;
use App\Models\Role;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\TransferComp;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['order_view','order_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Order::select()->paginate(PAGINATION_COUNT);
        return view('admin.order.index', compact('datas'));
    }

    public function create($id = null)
    {
        if(! Role::havePremission(['order_cr']))
            return redirect()->route('admin.dashboard');

        $order = $orderinfos = $recevs = [];
        $sups = Supplier::selection()->active()->get();
        $pros = Product::selection()->active()->get();
        $units = Unit::selection()->active()->get();
        if(isset($id)){
            $order = Order::selection()->find($id);
            $orderinfos = OrderInfo::selection()->where('order_id',$id)->get();
            $recevs = OrderReceive::selection()->where('order_id',$id)->get();
        }
        // dd($proCats);
        return view('admin.order.create',
        compact('order','orderinfos','sups','pros','units','recevs'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['order_cr']))
            return redirect()->route('admin.dashboard');

        try {
            $request->request->add(['admin_id' =>  Auth::user()->id ]);

            if (isset($request->orderid)){
                $data = Order::find($request->orderid);
                if (!$data) {
                    return redirect()->route('admin.order')->with(['error' => '  غير موجوده']);
                }
                if (isset($request->btn) && $request->btn == "ConfBtn"){
                    $prod = OrderInfo::where('order_id',$request->orderid)->count();
                    if($prod < 1){
                        $data->update($request->except(['_token']));
                        return redirect()->route('admin.order.create',$request->orderid)->with(['error'=>'يجب اضافه المنتجات اولا']);
                    }else{
                        $request->request->add(['status' =>  '5' ]);
                        $data->update($request->except(['_token']));
                    }
                }else{
                    $data->update($request->except(['_token']));
                }
            }else
                $spc= Order::create($request->except(['_token']));
            // Log::setLog('create','order',$spc->id,"","");

            return redirect()->route('admin.order')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.order.create')->with(['error'=>'يوجد خطء']);
        }
    }

    // Receive
    public function receiveView($oid, $id = null)
    {
        if(! Role::havePremission(['order_cr']))
            return redirect()->route('admin.dashboard');
        
        $data = $pros = $infos = [];
        $clears = ClearanceComp::selection()->active()->get();
        $trans = TransferComp::selection()->active()->get();
        $customers = Customer::selection()->active()->get();
        $stocks = Stock::selection()->active()->get();

        if (isset($id)){
            $data = OrderReceive::selection()->find($id);
            $pros = Product::selection()->active()->get();
            $infos = OrderReceiveInfo::selection()->where('order_receive_id',$id)->get();
        }
        
        // dd($proCats);
        return view('admin.order.receive',compact('oid','data','infos','clears','trans','customers','stocks','pros'));
    }

    public function receiveStore($oid, $id = null, Request $request)
    {
        if(! Role::havePremission(['order_cr']))
            return redirect()->route('admin.dashboard');
        
        try {
            if (isset($oid))
                $request->request->add(['order_id' =>  $oid ]);
            else
                return redirect()->route('admin.order')->with(['error' => ' حاول وقت اخر']);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
// dd($id);
            if (isset($id)){
                $data = OrderReceive::find($id);
                if (!$data) {
                    return redirect()->route('admin.order')->with(['error' => '  غير موجوده']);
                }
                // update
                if (!$request->has('where'))
                    $request->request->add(['where' => 0]);
                $data->update($request->except(['_token']));
            }else{
                // create
                if (!$request->has('where'))
                    $request->request->add(['where' => 0]);

                $spc= OrderReceive::create($request->except(['_token']));
                // Log::setLog('create','order',$spc->id,"","");
            }
             
            return redirect()->route('admin.order.create',$oid)->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.order')->with(['error'=>'يوجد خطء']);
        }
    }

    // AJAX

    public function setOrder(Request $request)
    {
        if(! Role::havePremission(['order_cr']))
            return "No Premission";

        try {

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $order= Order::create($request->except(['_token']));
            // Log::setLog('create','price_list_info',$PL->id,"","");
            $saveID = $order->id;
            return response()->json(['success'=>'Added','orderid'=>$saveID],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
        }
    }

    public function setOrderInfo(Request $request)
    {
        if(! Role::havePremission(['order_cr']))
            return "No Premission";

        try {

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $data= OrderInfo::create($request->except(['_token']));
            // Log::setLog('create','price_list_info',$PL->id,"","");

            return response()->json(['success'=>'Added','ordinfoid'=>$data->id],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
        }
    }

    public function getProductCat(Request $request)
    {
        if(! Role::havePremission(['order_cr']))
            return "No Premission";

        try {
            $proCats = [];

            if(isset($request->pro_id)){
                $proCats = ProductBuy::select('category')->active()->distinct('category')
                                        ->where('product_id', $request->pro_id)->get();
            }

            return response()->json($proCats,200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
        }
    }

    public function getProductUnit(Request $request)
    {
        if(! Role::havePremission(['order_cr']))
            return "No Premission";

        try {
            $proUnits = [];

            if(isset($request->pro_id) && isset($request->cat)){
                $proUnits = ProductBuy::getProductCategoryUnit($request->pro_id, $request->cat);
            }

            return response()->json($proUnits,200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
        }
    }

    public function destroyOrderInfo(Request $request)
    {
       
        try {

            $data = OrderInfo::find($request->id);
            if (!$data) {
                return response()->json(['success'=>0],400);
            }
            // Log::setLog('delete','request_call', $request->id, "", "");
            $data->delete();
            // $data->update(['status'=> '99']);
            
            return response()->json(['success'=>1 ],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>0],400);
        }
    }

    public function setOrderReceiveInfo(Request $request)
    {
        if(! Role::havePremission(['order_cr']))
            return "No Premission";

        try {

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $data= OrderReceiveInfo::create($request->except(['_token']));
            // Log::setLog('create','price_list_info',$PL->id,"","");

            return response()->json(['success'=>'Added','ordinfoid'=>$data->id],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
        }
    }

    public function destroyOrderReceiveInfo(Request $request)
    {
        try {
            $data = OrderReceiveInfo::find($request->id);
            if (!$data) {
                return response()->json(['success'=>0],400);
            }
            // Log::setLog('delete','request_call', $request->id, "", "");
            $data->delete();
            // $data->update(['status'=> '99']);
            
            return response()->json(['success'=>1 ],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>0],400);
        }
    }

    
/*
    public function edit($id)
    {
        if(! Role::havePremission(['order_view','order_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Order::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.order')->with(['error'=>"غير موجود"]);
        }
        $units = Unit::selection()->active()->get();
        $prbuys = orderBuy::selection()->active()->where('product_id',$id)->get();
    
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

    */
}
