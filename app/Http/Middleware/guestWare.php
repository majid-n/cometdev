<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Support\Facades\Auth;

class guestWare
{

    # Continue if the request was in GUEST role
    public function handle($request, Closure $next)
    {
        if ( Sentinel::check() ) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
