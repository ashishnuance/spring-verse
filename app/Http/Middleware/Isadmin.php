<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Isadmin
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
        // return $next($request);
        
        if (Auth::user() &&  Auth::user()->user_role()->role_id == 1) {
            return $next($request);
        }else if (Auth::user() &&  Auth::user()->user_role()->role_id == 2) {
            return  redirect()->route('home');
        }

        return redirect('/');
    }
}
