<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;

class Authenticate
{

    # Check if Somebody Login or Not
    public function handle(Request $request, Closure $next)
    {

        if ( Sentinel::check() )
        	return $next($request);

        if ( $request->ajax() ) 
        	return response('Unauthorized.', 401);
        else 
        	return redirect()->guest('login')->with('fail', 'جهت دسترسی به این صفحه به سایت وارد شوید.');
    }
}
