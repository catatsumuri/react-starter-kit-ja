<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwoFactorAuthenticationFeatureFlagTest extends TestCase
{
    use RefreshDatabase;

    public function test_two_factor_routes_return_404_when_feature_flag_is_disabled(): void
    {
        config(['features.two_factor_authentication.enabled' => false]);

        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['auth.password_confirmed_at' => time()])
            ->get(route('two-factor.show'))
            ->assertNotFound();

        $this->get(route('two-factor.login'))
            ->assertNotFound();
    }
}
