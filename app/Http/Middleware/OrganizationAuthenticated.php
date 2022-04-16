<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrganizationAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->organization == null) {
                
                return redirect()->route('home')->with('warning', 'you are not an aorganization, Plz register');
            } 
            else {
                return $next($request);
            }
        }
        return redirect()->route('login')->with('warning', 'you are not logged in, Plz login');
    }
}


// !return 401 unauthorized-------------------------------------