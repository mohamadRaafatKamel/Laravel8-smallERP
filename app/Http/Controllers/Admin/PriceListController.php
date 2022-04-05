<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\PriceListImport;
use App\Models\Category;
use App\Models\Log;
use App\Models\Package;
use App\Models\Role;
use App\Models\PriceList;
use App\Models\PriceListInfo;
use App\Models\PriceListRole;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PriceListController  extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['pricelist_view','pricelist_idt']))
            return redirect()->route('admin.dashboard');

        $datas = PriceList::select()->paginate(PAGINATION_COUNT);
        return view('admin.pricelist.index', compact('datas'));
    }

    // Create
    public function create()
    {
        if(! Role::havePremission(['pricelist_cr']))
            return redirect()->route('admin.dashboard');
        $priceLists = PriceList::select()->get();
        return view('admin.pricelist.create',compact('priceLists'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['pricelist_cr']))
            return redirect()->route('admin.dashboard');

            $request->validate([
                'name'=>"unique:price_list,name",
            ]);
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            if ($request->has('main_pl')){
                $pls = PriceList::all();
                foreach($pls as $pl){
                    $pl->update(['main_pl'=> '0']);
                }
            }

            $request->request->add(['main_pl' => 0]);
            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $PL= PriceList::create($request->except(['_token']));
            Log::setLog('create','price_list',$PL->id,"","");

            return redirect()->route('admin.pricelist.edit',$PL->id)->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.pricelist.create')->with(['error'=>'يوجد خطء']);
        }
    }

    // Import
    public function import()
    {
        if(! Role::havePremission(['pricelist_cr']))
            return redirect()->route('admin.dashboard');
        return view('admin.pricelist.import');
    }

    public function storeimport(Request $request)
    {
        if(! Role::havePremission(['pricelist_cr']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'csvfile'=>"required|mimes:xlsx",
        ]);

        dd($request->all());
        // try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            if ($request->has('main_pl')){
                $pls = PriceList::all();
                foreach($pls as $pl){
                    $pl->update(['main_pl'=> '0']);
                }
            }elseif(PriceList::Count() == 0){
                $request->request->add(['main_pl' =>  1 ]);
            }

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $PL= PriceList::create($request->except(['_token']));
            Log::setLog('create','price_list',$PL->id,"","");

            return redirect()->route('admin.pricelist.edit',$PL->id)->with(['success'=>'تم الحفظ']);
        // }catch (\Exception $ex){
        //     return redirect()->route('admin.pricelist.create')->with(['error'=>'يوجد خطء']);
        // }
    }

    public function importstore(Request $request)
    {
        if(! Role::havePremission(['pricelist_cr']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'name'=>"required|unique:price_list,name",
            'csvfile'=>"required|mimes:xlsx",
        ],[ 'mimes'=>"Must Excel",'required'=>"Required" ]);

        try{
            $pl = new PriceList();
            $pl->name = $request->name;
            $pl->main_pl = 0 ;
            $pl->admin_id = Auth::user()->id;
            $pl->save();

            $validator = new PriceListImport($pl->id);

            Excel::import($validator, request()->file('csvfile'));

            // dd($validator->errors);
            if (count($validator->errors)) {
                $errors = [];
                foreach ($validator->errors as $key => $error) {
                    $errors[$key] = $error;
                }
        
                // return redirect()->route('admin.pricelist')->with('error', count($validator->errors).'rows incorrect data');
                return redirect()->route('admin.pricelist')->with('error', 'row  ' . implode(', ', $errors) . ' contain incorrect data');
            } elseif (!$validator->isValidFile) {
                return redirect()->route('admin.pricelist')->with(['success'=>'تم الحفظ']);
            }

            //     return redirect()->route('admin.pricelist')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.pricelist.import')->with(['error'=>"Try other time"]);
        }
    }

    // update
    public function edit($id)
    {
        if(! Role::havePremission(['pricelist_view','pricelist_idt']))
            return redirect()->route('admin.dashboard');

        $datas = PriceList::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.pricelist')->with(['error'=>"غير موجود"]);
        }

        $priceLists = PriceList::select()->where('id','!=',$id)->get();
        $categorys = Category::selection()->get();
        $rolls = PriceListRole::select()->where('price_list_id',$id)->get();
        $services = Service::selection()->get();
        $srvs = PriceListInfo::select()->where('price_list_id',$id)->where('service_id','!=','Null')->get();
        $packages = Package::selection()->get();
        $packs = PriceListInfo::select()->where('price_list_id',$id)->where('package_id','!=','Null')->get();

        return view('admin.pricelist.edit',compact('datas','priceLists','categorys','rolls','services','srvs','packages','packs'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['pricelist_idt']))
            return redirect()->route('admin.dashboard');

        // try {
            $data = PriceList::find($id);
            if (!$data) {
                return redirect()->route('admin.pricelist.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);
            // if (!$request->has('main_pl'))
            //     $request->request->add(['main_pl' => 0]);
            if ($request->has('main_pl'))
                if($request->main_pl != $data->main_pl){
                    $pls = PriceList::all();
                    foreach($pls as $pl){
                        $pl->update(['main_pl'=> '0']);
                    }
                }

            $request->request->add(['status' => 1 ]);

            Log::setLog('update','price_list',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.pricelist')->with(['success' => 'تم التحديث بنجاح']);

        // } catch (\Exception $ex) {
        //     return redirect()->route('admin.pricelist')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        // }
    }

    public function destroyRoll($plid, $id)
    {

        try {
            $data = PriceListRole::find($id);
            if (!$data) {
                return redirect()->route('admin.pricelist', $id)->with(['error' => '  غير موجوده']);
            }
            Log::setLog('delete','price_list_role',$data->id,"","");
            $data->delete();

            return redirect()->route('admin.pricelist.edit',$plid)->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.pricelist.edit',$plid)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    public function destroyService($plid, $id)
    {

        try {
            $data = PriceListInfo::find($id);
            if (!$data) {
                return redirect()->route('admin.pricelist', $id)->with(['error' => '  غير موجوده']);
            }
            Log::setLog('delete','price_list_info',$data->id,"","");
            $data->delete();

            return redirect()->route('admin.pricelist.edit',$plid)->with(['success' => 'تم حذف  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.pricelist.edit',$plid)->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // JSON
    public function setRoll(Request $request)
    {
        
        if(! Role::havePremission(['pricelist_cr']))
            return redirect()->route('admin.dashboard');

        try {
            
            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $PL= PriceListRole::create($request->except(['_token']));
            Log::setLog('create','price_list_role',$PL->id,"","");

            return response()->json(['success'=>'Added','rollid'=>$PL->id],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
        }
    }
    
    public function setService(Request $request)
    {
        if(! Role::havePremission(['pricelist_cr']))
            return redirect()->route('admin.dashboard');

        try {
            $saveID = 0;
            if(isset($request->service_id) && isset($request->price_list_id)){
                $data = PriceListInfo::select()->where('service_id',$request->service_id)->where('price_list_id',$request->price_list_id)->first();
                if(isset($data->id)){
                    $saveID = $data->id;
                    Log::setLog('update','price_list_info',$data->id,"",$request->except(['_token']) );
                    $data->update(['price'=> $request->price]);
                }else{
                    $request->request->add(['admin_id' =>  Auth::user()->id ]);
                    $PL= PriceListInfo::create($request->except(['_token']));
                    Log::setLog('create','price_list_info',$PL->id,"","");
                    $saveID = $PL->id;
                }
            }elseif(isset($request->package_id) && isset($request->price_list_id)){
                $data = PriceListInfo::select()->where('package_id',$request->package_id)->where('price_list_id',$request->price_list_id)->first();
                if(isset($data->id)){
                    $saveID = $data->id;
                    Log::setLog('update','price_list_info',$data->id,"",$request->except(['_token']) );
                    $data->update(['price'=> $request->price]);
                }else{
                    $request->request->add(['admin_id' =>  Auth::user()->id ]);
                    $PL= PriceListInfo::create($request->except(['_token']));
                    Log::setLog('create','price_list_info',$PL->id,"","");
                    $saveID = $PL->id;
                }
            }
            return response()->json(['success'=>'Added','srvid'=>$saveID],200);
        }catch (\Exception $ex){
            return response()->json(['success'=>$ex],400);
        }
    }
   

    

   
}
