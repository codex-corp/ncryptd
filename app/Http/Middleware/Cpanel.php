<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;

class Cpanel
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
        if ($request->ajax())
        {
            return response('Unauthorized.', 401);
        }
        else
        {
            if (!Auth::check())
            {
                // Redirect to the login page
                return Redirect::route('signin');
            }

        }
        return $next($request);
    }
}
