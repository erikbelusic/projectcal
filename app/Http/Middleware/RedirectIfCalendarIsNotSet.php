<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RedirectIfCalendarIsNotSet
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next,  $guard = null)
    {
        if (Auth::guard($guard)->user()->calendar_id == null) {
            return redirect('/settings');
        }

        return $next($request);
    }
}
