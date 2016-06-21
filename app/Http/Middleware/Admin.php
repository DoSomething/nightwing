<?php

namespace Nightwing\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Admin
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
        if (! Auth::user() || ! Auth::user()->admin) {
            return redirect(route('home'));        
        }

        return $next($request);
    }
}
