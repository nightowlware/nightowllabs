<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

// IMPORTANT NOTE: "SuperUser" and "Admin" are synonyms in this application

class IsSuperUser
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
        if (Auth::user() && Auth::user()->is_super_user == 1) {
            return $next($request);
        }

        return redirect('/');
    }
}
