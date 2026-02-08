<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountDeletionFeatureFlagTest extends TestCase
{
    use RefreshDatabase;

    public function test_account_deletion_returns_404_when_disabled(): void
    {
        config(['features.account_deletion.enabled' => false]);

        $user = User::factory()->create();

        $this->actingAs($user)
            ->delete(route('profile.destroy'), [
                'password' => 'password',
            ])
            ->assertNotFound();

        $this->assertNotNull($user->fresh());
    }
}
