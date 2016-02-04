<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class roleWare
{
    # Continue if the user had the specific role
    public function handle($request, Closure $next, $role)
    {
    	
    	if( Sentinel::check() ) {
    		if ( !Sentinel::inRole($role) ) return redirect('/')->withErrors('شما امکان دسترسی به این محدوده را ندارید.');
    	} else { 
    		return redirect('/');
    	}
        
        return $next($request);
    }
}