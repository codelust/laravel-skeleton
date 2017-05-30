<?php

namespace Frontiernxt\Middleware;

use Illuminate\Http\Request;
use Closure;

class AuthenticateAPI
{

	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        return $next($request);
    }	
}