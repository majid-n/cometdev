<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;

class RoleWare
{
    # Continue if the user had the specific role
    public function handle( Request $request, Closure $next, $role )
    {
    	
        if( Sentinel::check() ) {
            if( Sentinel::inRole($role) ) 
                return $next($request);
        }

        if( $request->ajax() ) 
            return response('Notfound.', 404);
        else 
            abort(404);
    }
}
