<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->api_password !== "WvxEe95Sqn+OADxWtLg/QV4WEyyATQ="){
            return response()->json(['massage'=> 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
}
