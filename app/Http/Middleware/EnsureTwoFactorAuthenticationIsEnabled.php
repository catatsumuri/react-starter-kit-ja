<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorAuthenticationIsEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('features.two_factor_authentication.enabled', true)) {
            // Block all 2FA-related entrypoints while keeping Fortify features enabled.
            if ($request->routeIs('two-factor.*')) {
                abort(404);
            }

            if ($request->is(
                'two-factor-challenge',
                'settings/two-factor',
                'user/two-factor-*',
                'user/confirmed-two-factor-authentication',
            )) {
                abort(404);
            }
        }

        return $next($request);
    }
}
