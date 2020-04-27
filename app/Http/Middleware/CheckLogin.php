<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::get('login')) {
            return redirect('auth/login')->with('message', 'Kamu harus login dulu');
        } else {
            return $next($request);
        }
    }
}
