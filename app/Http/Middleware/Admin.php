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
        if (! Auth::user() || ! Auth::user()->role !== 'admin') {
            return redirect('/')->with('flash_message', [
                'class' => 'messages -error',
                'text' =>'You must be an admin to do that.'
            ]);
        }

        return $next($request);
    }
}
