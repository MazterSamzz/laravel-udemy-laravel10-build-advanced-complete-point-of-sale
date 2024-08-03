<?php

namespace App\Http\Middleware;

use App\Helpers\LogHelper;
use Closure;
use Illuminate\Http\Request;

class LogUserActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        LogHelper::user($request);

        return $next($request);
    }
}
