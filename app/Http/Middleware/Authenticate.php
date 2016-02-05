<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( !Sentinel::check() ) {

            if ( $request->ajax() ) return response('Unauthorized.', 401);
            else return redirect()->route('login')->with('fail', 'جهت دسترسی به این صفحه به سایت وارد شوید.');
        }

        return $next($request);
    }
}
