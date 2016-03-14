<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Requests;
use Sentinel;

class OwnerWare
{
    # Detect this Request is form Owner or Admin 
    public function handle(Request $request, Closure $next)
    {   
        
        # Get All Route Parameter Passed Throw Route
        $requestparameters = $request->route()->parameters();

        foreach ($requestparameters as $requestparameter) {
            
            # Loop through route parameters And Find Model Object
            if ( is_object($requestparameter) ) {

                # Route Model Binding is active for this parameter
                if ( isset($requestparameter->id) ) {

                    # Get Login User
                    $user = Sentinel::getUser();

                    if ( $requestparameter->id === $user->id || $user->inRole('admins') ) {
                        # Authenticated user is the not owner
                        return $next($request);
                    }
                }
            }
        }

        if( $request->ajax() ) response('Unauthorized.', 401);
        else abort(401);
    }
}
