<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ServiceImport;
use App\Models\Category;
use App\Models\Log;
use App\Models\Role;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ServiceController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['serves_view','serves_idt']))
            return redirect()->route('admin.dashboard');
        $datas = Service::select()->paginate(PAGINATION_COUNT);
        return view('admin.service.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['serves_cr']))
            return redirect()->route('admin.dashboard');

        $categorys = Category::selection()->get();
        return view('admin.service.create',compact('categorys'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['serves_cr']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'name_en'=>"unique:service,name_en",
        ]);
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            if (!$request->has('site'))
                $request->request->add(['site' => 0]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);

            if ($request->has('img')){
                $image = $request->file('img');
                $imageName = "serv_".str_replace(' ', '_', $request->name_en) . ".". $image->extension();
                $image->move(public_path('service'),$imageName);
                $request->request->add(['image' =>  "public/service/".$imageName ]);
            }
            
            $serv = Service::create($request->except(['_token']));
            Log::setLog('create','service',$serv->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.service.create')->with(['success'=>'تم الحفظ']);

            return redirect()->route('admin.service')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.service.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function import()
    {
        if(! Role::havePremission(['serves_cr']))
            return redirect()->route('admin.dashboard');
        return view('admin.service.import');
    }

    public function importstore(Request $request)
    {
        if(! Role::havePremission(['serves_cr']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'csvfile'=>"required|mimes:xlsx",
        ],[ 'mimes'=>"Must Excel",'required'=>"Required" ]);

        try{
            $validator = new ServiceImport();
            Excel::import($validator, request()->file('csvfile'));

            // dd($validator->errorRow);
            if (count($validator->errors)) {
                // $errors = [];
                // foreach ($validator->errors as $key => $error) {
                //     $errors[$key] = $key;
                // }
        
                return redirect()->route('admin.service')->with('error', count($validator->errors).'rows incorrect data');
                // return redirect()->back()->with('error', 'row number ' . implode(',', $errors) . ' contain incorrect data');
            } elseif (!$validator->isValidFile) {
                return redirect()->route('admin.service')->with(['success'=>'تم الحفظ']);
            }

            //     return redirect()->route('admin.service')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.service.import')->with(['error'=>"Try other time"]);
        }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['serves_view','serves_idt']))
            return redirect()->route('admin.dashboard');
        $datas = Service::select()->find($id);
        $categorys = Category::selection()->get();
        if(!$datas){
            return redirect()->route('admin.service')->with(['error'=>"غير موجود"]);
        }
        return view('admin.service.edit',compact('datas','categorys'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['serves_idt']))
            return redirect()->route('admin.dashboard');

        $vdata = Service::find($id);
        if ($request->name_en != $vdata->name_en ){
            $request->validate([
                'name_en'=>"unique:service,name_en",
            ]);
        }
        try {
            $data = Service::find($id);
            if (!$data) {
                return redirect()->route('admin.service.edit', $id)->with(['error' => ' غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);
            if (!$request->has('site'))
                $request->request->add(['site' => 0]);

            if ($request->has('img')){
                $image = $request->file('img');
                $imageName = "serv_".str_replace(' ', '_', $request->name_en) . ".". $image->extension();
                $image->move(public_path('service'),$imageName);
                $imgPath = "public/service/".$imageName;
            }else{
                $imgPath = $data->image;
            }
            $request->request->add(['image' => $imgPath]);

            Log::setLog('update','service',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.service')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.service')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = Service::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.service', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.service')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.service')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
