<?php

namespace App\Http\Middleware;

use Closure;

class Locale
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
        if ($request->method() === 'GET') {
            $segment = $request->segment(1);

            if (!in_array($segment, config('portal.locales'))) {
                $segments = $request->segments();
                $fallback = session('locale') ?: config('app.locale');
                $segments = array_prepend($segments, $fallback);

                $redirect_path = $fallback . '/' . $this->fullPath($request);
                $request->session()->reflash();
                return redirect()->to($redirect_path);
            }

            // set locale data in session
            session(['locale' => $segment]);
            session(['locale_id' => array_search($segment, config('portal.locales'))]);

            app()->setLocale($segment);

            // Unset "locale" parameter on the route if it is set.
            // for not sending the request to controllers action
            $request->route()->forgetParameter('locale');
        }

        return $next($request);
    }

    /**
     * Get the full path for the request.
     *
     * @return string
     */
    private function fullPath($request)
    {
        $query = $request->getQueryString();

        $question = $request->getBaseUrl() . $request->getPathInfo() == '/' ? '/?' : '?';

        return $query ? $request->path() . $question . $query : $request->path();
    }
}
