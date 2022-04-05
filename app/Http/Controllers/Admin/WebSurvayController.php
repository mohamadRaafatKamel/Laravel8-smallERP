<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\WebSurvay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use phpDocumentor\Reflection\Types\Null_;

class WebSurvayController extends Controller
{
    public function index()
    {
        if(! Role::havePremission(['survey_view']))
            return redirect()->route('admin.dashboard');

        $datas = WebSurvay::select()->paginate(PAGINATION_COUNT);
        return view('admin.websurvay.index', compact('datas'));
    }

    public function statistics()
    {
        if(! Role::havePremission(['survey_view']))
            return redirect()->route('admin.dashboard');
            
        $opinionAge1 = WebSurvay::select('opinion_carehub as opinion', DB::raw('count(*) as total'))
                                ->where('age','1')->groupBy('opinion_carehub')->get();
        $opinionAge2 = WebSurvay::select('opinion_carehub as opinion', DB::raw('count(*) as total'))
                                ->where('age','2')->groupBy('opinion_carehub')->get();
        $opinionAge3 = WebSurvay::select('opinion_carehub as opinion', DB::raw('count(*) as total'))
                                ->where('age','3')->groupBy('opinion_carehub')->get();
        $opinionAge4 = WebSurvay::select('opinion_carehub as opinion', DB::raw('count(*) as total'))
                                ->where('age','4')->groupBy('opinion_carehub')->get();
        $opAge1=$opAge2=$opAge3=$opAge4=[0,0,0,0,0];
        // dd($opinionAge4['0']['total']);
        foreach($opinionAge1 as $op){
            if($op['opinion']!= Null) 
                $opAge1[$op['opinion']] = $op['total'];
        }
        foreach($opinionAge2 as $op){
            if($op['opinion']!= Null) 
                $opAge2[$op['opinion']] = $op['total'];
        }
        foreach($opinionAge3 as $op){
            if($op['opinion']!= Null) 
                $opAge3[$op['opinion']] = $op['total'];
        }
        foreach($opinionAge4 as $op){
            if($op['opinion']!= Null) 
                $opAge4[$op['opinion']] = $op['total'];
        }
        
        $data = [
            'opinion1' => $this->arrayToStr($opAge1),
            'opinion2' => $this->arrayToStr($opAge2),
            'opinion3' => $this->arrayToStr($opAge3),
            'opinion4' => $this->arrayToStr($opAge4),
        ];
        // dd($opAge4);
        return view('admin.websurvay.statistics', compact('data'));
    }

    public function arrayToStr($array)
    {
        $text="";
        for($i=1;$i<5;$i++){
            $text .= ",".$array[$i];
        }
        // dd($text);
        return $text;
    }

}
