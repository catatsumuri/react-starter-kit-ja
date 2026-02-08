<?php

namespace Tests\Feature;

use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class FeatureFlagsSharedWithInertiaTest extends TestCase
{
    public function test_feature_flags_are_shared_with_inertia(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->has('features.registration.enabled')
                ->has('features.two_factor_authentication.enabled')
                ->has('features.password_visibility_toggle.enabled')
                ->has('features.flash_toast.enabled')
                ->has('features.appearance.enabled')
                ->has('features.account_deletion.enabled')
            );
    }
}
