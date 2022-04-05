<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        if($request->language == 'ar' or $request->language == 'en'){
//            \App::setLocale($request->language);
//        }elseif ($request->language == 'admin'){
//            redirect(route('admin.getlogin'));
//        }

//        dd($request->route()->getPrefix());
//dd(strpos($request->route()->getPrefix(), 'ss'));

        // if($request->language == 'ar' or $request->language == 'en'){
        //     \App::setLocale($request->language);
        //     unset($_COOKIE['lang']);
        //     setcookie('lang',$request->language, time() + (86400 * 30 * 30), "/");
        // }elseif(!isset($request->language) and strpos($request->route()->getPrefix(), 'admin') !== false ){
        //     if(isset($_COOKIE['lang'])){
        //         \App::setLocale($_COOKIE['lang']);
        //     }
        // }

//        elseif ($request->language == 'admin') {
//            redirect(route('admin.getlogin'));
//        }

        return $next($request);
    }
}
