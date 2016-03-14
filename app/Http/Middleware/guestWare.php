<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;

class GuestWare
{

    # Continue if the request was in GUEST role
    public function handle( Request $request, Closure $next )
    {
        if ( Sentinel::check() ) 
        	return redirect()->home();

        return $next($request);
    }
}
