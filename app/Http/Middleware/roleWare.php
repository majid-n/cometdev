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
    		if ( !Sentinel::inRole($role) ) return redirect()->route('home')->with('fail', 'شما امکان دسترسی به این محدوده را ندارید.');
    	} else { 
    		return redirect()->route('home');
    	}
        
        return $next($request);
    }
}
