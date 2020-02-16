<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Session;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()  ) {
            return redirect()->route('login');
        }
        if( !Auth::user()->adminworthy() ){
            Session:flash('success','You are nor authorised to view this section of the Site!!!');
            return redirect()->route('home');
        }else{
            return $next($request);
        }
        // return $next($request);
    }
}
