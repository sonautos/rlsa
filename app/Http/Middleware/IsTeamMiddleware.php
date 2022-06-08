<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsTeamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->is_admin || !auth()->user()->is_team ) {
            return redirect()->route('user.home');
        }
        return $next($request);
    }
}
