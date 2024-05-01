<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
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


        // except route that are not registered as module in db
        if (in_array(request()->route()->getName(), ['sample_route_name', 'dashboard'])) {
            return $next($request);
        }

        if (has_access_to_action(get_current_action()->id)) {
            return $next($request);
        }

        abort('403', 'Permission Denied');
    }
}
