<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppearanceFeatureFlagTest extends TestCase
{
    use RefreshDatabase;

    public function test_appearance_settings_page_returns_404_when_disabled(): void
    {
        config(['features.appearance.enabled' => false]);

        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)->get(route('appearance.edit'))
            ->assertNotFound();
    }

    public function test_appearance_cookie_is_expired_when_feature_is_disabled(): void
    {
        config(['features.appearance.enabled' => false]);

        $this->withCookie('appearance', 'dark')
            ->get(route('home'))
            ->assertOk()
            ->assertCookieExpired('appearance');
    }
}
