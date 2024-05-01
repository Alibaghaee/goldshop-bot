<?php

namespace App\Http\Middleware;

use Closure;

class PayedMiddleware
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
        if (auth()->user()->payable_price > 0) {
            return redirect(route('pay_page.index'));
        }
        return $next($request);
    }
}
