<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('user')->check()){
            return $next($request);
        }
        return response()->json([
            "status"=>1000,
            "message"=>"You must be Logged In"
        ]);
    }
}
