<?php

namespace MrLks\CloudflareTurnstileLaravel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use MrLks\CloudflareTurnstileLaravel\Facades\Turnstile;

class TurnstileMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->input('cf-turnstile-response');

        if (!$token || !Turnstile::verify($token)) {
            return response()->json([
                'message' => 'Turnstile verification failed.',
                'errors' => [
                    'cf-turnstile-response' => ['The Turnstile verification failed.']
                ]
            ], 422);
        }

        return $next($request);
    }
}