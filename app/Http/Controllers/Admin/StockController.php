<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Role;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['stock_view','stock_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Stock::select()->paginate(PAGINATION_COUNT);
        return view('admin.stock.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['stock_cr']))
            return redirect()->route('admin.dashboard');

        return view('admin.stock.create');
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['stock_cr']))
            return redirect()->route('admin.dashboard');

        
        try {
            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= Stock::create($request->except(['_token']));
            // Log::setLog('create','stock',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.stock.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.stock')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.stock.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['stock_view','stock_idt']))
            return redirect()->route('admin.dashboard');

        $datas = Stock::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.stock')->with(['error'=>"غير موجود"]);
        }
        return view('admin.stock.edit',compact('datas'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['stock_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Stock::find($id);
            if (!$data) {
                return redirect()->route('admin.stock.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('status'))
                $request->request->add(['status' => 1]);

            // Log::setLog('update','stock',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.stock')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.stock')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = stock::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.stock', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.stock')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.stock')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
