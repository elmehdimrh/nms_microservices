<?php

namespace App\Http\Middleware;

use Closure;

class TokenMiddleware
{

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
