<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo( $request)
    {
        // dd(session()->all());
        if (!session()->has('user')) {
            return redirect()->route('login');
        }
        // return $next($request);
    }
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
        
    // }
    // public function handle($request, \Closure $next, ...$guards)
    // {
    //     dump(session()->has('user'));
    //     // if (!session()->has('user')) {
    //     //     return redirect()->route('home');
    //     // }
    
    //     return $next($request);
    // }
    
}
