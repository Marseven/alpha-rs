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

    public function test_he_can_blocks_action_without_fine_grained_permission(): void
    {
        $admin = $this->makeAdmin();
        $folder = $this->makeFolder($admin);

        // Role has a 'Folders' permission row but the 'updat' flag is OFF.
        $permId = \Illuminate\Support\Facades\DB::table('security_permissions')->insertGetId([
            'name' => 'Folders',
            'description' => 'Folders',
        ]);
        \Illuminate\Support\Facades\DB::table('security_role_permission')->insert([
            'security_role_id' => $admin->security_role_id,
            'security_permission_id' => $permId,
            'look' => 'on',
            'updat' => null, // not "on" => update must be denied
        ]);

        $this->actingAs($admin)
            ->post('/admin/folder/' . $folder->id, ['lastname' => 'X'])
            ->assertForbidden();
    }
}
