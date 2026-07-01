<?php

namespace Tests\Feature\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Regression tests for the custom password-change endpoint
 * (POST /userpassword/{user}). The legacy version let any authenticated
 * user reset ANY account's password by posting that account's email.
 */
class PasswordChangeTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_user_cannot_change_another_users_password_via_email(): void
    {
        $attacker = $this->makeUser(['password' => 'attacker-pass']);
        $victim = $this->makeUser(['email' => 'victim@example.test', 'password' => 'victim-pass']);

        $this->actingAs($attacker)->post('/userpassword/' . $attacker->id, [
            'email' => $victim->email,           // trying to target the victim
            'current_password' => 'attacker-pass',
            'password' => 'hacked-password',
            'password_confirmation' => 'hacked-password',
        ]);

        $victim->refresh();
        $this->assertTrue(
            Hash::check('victim-pass', $victim->password),
            'The victim password must remain unchanged.'
        );
    }

    public function test_user_cannot_change_password_without_current_password(): void
    {
        $user = $this->makeUser(['password' => 'original-pass']);

        $this->actingAs($user)->post('/userpassword/' . $user->id, [
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
            // no current_password provided
        ]);

        $user->refresh();
        $this->assertTrue(
            Hash::check('original-pass', $user->password),
            'Password must not change without the current password.'
        );
    }

    public function test_user_can_change_their_own_password_with_current_password(): void
    {
        $user = $this->makeUser(['password' => 'original-pass']);

        $this->actingAs($user)->post('/userpassword/' . $user->id, [
            'current_password' => 'original-pass',
            'password' => 'brand-new-pass',
            'password_confirmation' => 'brand-new-pass',
        ]);

        $user->refresh();
        $this->assertTrue(
            Hash::check('brand-new-pass', $user->password),
            'The user should be able to change their own password.'
        );
    }
}
