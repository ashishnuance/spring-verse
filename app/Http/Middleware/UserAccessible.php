<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class UserAccessible
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('Authorization')){
            $auth_token = $request->header('Authorization');
            $result = DB::table('users')->where('token_firebase',$auth_token)->count();
            // return response()->json([$request->header('Authorization'),$result]);
            if ($result==0) {
                return response()->json([
                    'message' => 'Unauthorized'
                ],401);
            }
            return $next($request);
        }else{
            return response()->json([
                'message' => 'Url not authorized'
            ]);
        }
    }
}
