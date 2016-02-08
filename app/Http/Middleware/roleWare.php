<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;

class roleWare
{
    # Continue if the user had the specific role
    public function handle( Request $request, Closure $next, $role )
    {
    	
    	if( Sentinel::check() ) {
    		if ( !Sentinel::inRole($role) ) return redirect()->home()->with('fail', 'شما امکان دسترسی به این محدوده را ندارید.');
    	} else { 
            # throw 404 not found Error
    		abort(404);
    	}
        
        return $next($request);
    }
}
