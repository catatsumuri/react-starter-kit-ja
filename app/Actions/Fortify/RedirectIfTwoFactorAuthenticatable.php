<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable as BaseRedirectIfTwoFactorAuthenticatable;

class RedirectIfTwoFactorAuthenticatable extends BaseRedirectIfTwoFactorAuthenticatable
{
    /**
     * When 2FA is disabled at the app level, always proceed with password-only login.
     */
    public function handle($request, $next)
    {
        if (! config('features.two_factor_authentication.enabled', true)) {
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
