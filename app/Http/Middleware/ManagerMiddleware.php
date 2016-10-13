<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class ManagerMiddleware
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
        if (Auth::user()->type != 'manager') {
            return abort(403, 'This action forbidden for you!');
        }
        return $next($request);
    }
}
