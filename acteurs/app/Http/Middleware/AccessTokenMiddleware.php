<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class AccessTokenMiddleware
{

    public function handle($request, Closure $next)
    {
        $issued_token = $request->bearerToken();

        if(!$issued_token) {
            return response()->json([
                'error' => 'Token not provided.'
            ], 401);
        }

        if(!$this->verifyToken($issued_token)) {
            return response()->json([
                'error' => 'Token invalid.'
            ], 401);
        }

        return $next($request);
    }

    private function verifyToken($token){

        $decoded = explode(':',base64_decode($token));

        if($decoded[0] === "actors" && $decoded[1] === "20nomalis21") {
            return true;
        }

        return false;

    }

}
