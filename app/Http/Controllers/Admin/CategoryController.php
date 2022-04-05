<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CategoryImport;
use App\Models\Log;
use App\Models\Role;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['category_view','category_idt']))
            return redirect()->route('admin.dashboard');
        $cat = new Category();

        $datas = $cat->getVal($cat->selection()->get());
        return view('admin.category.index', compact('datas'));
    }

    public function create()
    {
        if(! Role::havePremission(['category_cr']))
            return redirect()->route('admin.dashboard');
        $generals = Category::selection()->get();
        return view('admin.category.create',compact('generals'));
    }

    public function store(Request $request)
    {
        if(! Role::havePremission(['category_cr']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'name_en'=>"unique:category,name_en",
        ]);
        try {
            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            $request->request->add(['admin_id' =>  Auth::user()->id ]);
            $spc= Category::create($request->except(['_token']));
            Log::setLog('create','category',$spc->id,"","");

            if(isset($request->btn))
                if($request->btn =="saveAndNew")
                    return redirect()->route('admin.category.create')->with(['success'=>'تم الحفظ']);
        
            return redirect()->route('admin.category')->with(['success'=>'تم الحفظ']);
        }catch (\Exception $ex){
            return redirect()->route('admin.category.create')->with(['error'=>'يوجد خطء']);
        }
    }

    public function import()
    {
        if(! Role::havePremission(['category_cr']))
            return redirect()->route('admin.dashboard');
        return view('admin.category.import');
    }

    public function importstore(Request $request)
    {
        if(! Role::havePremission(['category_cr']))
            return redirect()->route('admin.dashboard');

        $request->validate([
            'csvfile'=>"required|mimes:xlsx",
        ],[ 'mimes'=>"Must Excel",'required'=>"Required" ]);

        // try{
            $validator = new CategoryImport();
            Excel::import($validator, request()->file('csvfile'));

            // dd($validator->errors);
            if (count($validator->errors)) {
                // $errors = [];
                // foreach ($validator->errors as $key => $error) {
                //     $errors[$key] = $key;
                // }
        
                return redirect()->route('admin.category')->with('error', count($validator->errors).'rows incorrect data');
                // return redirect()->back()->with('error', 'row number ' . implode(',', $errors) . ' contain incorrect data');
            } else{
                return redirect()->route('admin.category')->with(['success'=>'تم الحفظ']);
            }

            //     return redirect()->route('admin.category')->with(['success'=>'تم الحفظ']);
            
        // }catch (\Exception $ex){
        //     return redirect()->route('admin.category.import')->with(['error'=>"Try other time"]);
        // }
    }

    public function edit($id)
    {
        if(! Role::havePremission(['category_view','category_idt']))
            return redirect()->route('admin.dashboard');
        $generals = Category::select()->where('id','!=',$id)->get();
        $datas = Category::select()->find($id);
        if(!$datas){
            return redirect()->route('admin.category')->with(['error'=>"غير موجود"]);
        }
        return view('admin.category.edit',compact('datas','generals'));
    }

    public function update($id, Request $request)
    {
        if(! Role::havePremission(['category_idt']))
            return redirect()->route('admin.dashboard');

        try {
            $data = Category::find($id);
            if (!$data) {
                return redirect()->route('admin.category.edit', $id)->with(['error' => '  غير موجوده']);
            }

            if (!$request->has('disabled'))
                $request->request->add(['disabled' => 1]);

            Log::setLog('update','category',$id,"",$request->except(['_token']) );
            $data->update($request->except(['_token']));

            return redirect()->route('admin.category')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

    // public function destroy($id)
    // {

    //     try {
    //         $data = Category::find($id);
    //         if (!$data) {
    //             return redirect()->route('admin.category', $id)->with(['error' => '  غير موجوده']);
    //         }
    //         $data->delete();

    //         return redirect()->route('admin.category')->with(['success' => 'تم حذف  بنجاح']);

    //     } catch (\Exception $ex) {
    //         return redirect()->route('admin.category')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    //     }
    // }
}
