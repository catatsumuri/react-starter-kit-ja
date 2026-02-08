<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class HandleAppearance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If appearance feature is disabled, force system theme
        if (! config('features.appearance.enabled', true)) {
            View::share('appearance', 'system');

            // Clear the appearance cookie if it exists
            $response = $next($request);
            if ($request->hasCookie('appearance')) {
                return $response->withoutCookie('appearance');
            }

            return $response;
        }

        View::share('appearance', $request->cookie('appearance') ?? 'system');

        return $next($request);
    }
}
