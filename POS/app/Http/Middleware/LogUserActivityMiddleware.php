<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogUserActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log the user action after the response
        $route = $request->route();
        $routeName = $route ? $route->getName() : 'undefined';
        $userId = $request->user() ? $request->user()->id : 'guest';

        if (in_array($routeName, ['profile.edit', 'profile.update', 'profile.destroy'])) {
            Log::info("User activity", [
                'user_id' => $userId,
                'route' => $routeName,
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
