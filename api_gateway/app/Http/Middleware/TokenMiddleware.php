<?php

namespace App\Http\Middleware;

use App\Models\Microservice;
use Closure;

class TokenMiddleware
{

    public function handle($request, Closure $next)
    {
        $issued_token = $request->bearerToken();

        if(!$issued_token) {
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }

        $saved_token = Microservice::where('nom','gateway')->value('token');

        if($issued_token != $saved_token) {
            return response()->json([
                'error' => 'Token invalid.'
            ], 401);
        }

        return $next($request);
    }
}
