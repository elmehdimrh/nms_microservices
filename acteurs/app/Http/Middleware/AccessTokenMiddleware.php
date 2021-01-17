<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class AccessTokenMiddleware
{
    private $token_service_url = 'http://localhost:7000/token';

    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if(!$token) {
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }

        return $next($request);
    }

}
