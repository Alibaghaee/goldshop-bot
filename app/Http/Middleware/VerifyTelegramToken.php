<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyTelegramToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-Telegram-Bot-Api-Secret-Token');

        if ($token !== env('TELEGRAM_SECRET_HEADER')) {

            return response('Unauthorized', 401);
        }



        return $next($request);
    }
}
