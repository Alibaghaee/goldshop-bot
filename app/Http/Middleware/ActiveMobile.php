<?php

namespace App\Http\Middleware;

use Closure;

class ActiveMobile
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

        if (auth()->guard('web')->check()){

            if (!auth()->user()->active_mobile){

                return redirect()->route('otp.request.active.mobile', app()->getLocale());
            }

        }

        return $next($request);
    }
}
