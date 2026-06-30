<?php

namespace Tests\Feature\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Back-office access control. Only users whose role maps to the "admin"
 * security object may reach the /admin/* area.
 */
class AdminAccessTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_guest_cannot_access_backoffice(): void
    {
        $this->get('/admin/dashboard')->assertRedirect();
    }

    public function test_non_admin_cannot_access_backoffice(): void
    {
        $user = $this->makeUser();

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertRedirect('/');
    }

    public function test_admin_can_access_backoffice(): void
    {
        $admin = $this->makeAdmin();

        $this->actingAs($admin)->get('/admin/dashboard')->assertOk();
    }
}
