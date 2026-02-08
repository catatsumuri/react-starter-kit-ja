<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAppearanceIsEnabled
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('features.appearance.enabled', true)) {
            if ($request->routeIs('appearance.*')) {
                abort(404);
            }

            if ($request->is('settings/appearance')) {
                abort(404);
            }
        }

        return $next($request);
    }
}
