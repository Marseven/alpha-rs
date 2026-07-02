<?php

namespace Tests\Feature\Security;

use App\Models\SecurityObject;
use App\Models\SecurityPermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Regression guard for the RBAC back-office (roles / objects / permissions).
 *
 * This area has no other coverage and relies on the shared CRUD base
 * (index/save are custom, edit/delete are inherited). These smoke tests lock
 * the observable behaviour so the base can be refactored safely.
 */
class RbacBackofficeTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_admin_can_view_rbac_index_pages(): void
    {
        $admin = $this->makeAdmin();

        $this->actingAs($admin)->get('/admin/security-role')->assertOk();
        $this->actingAs($admin)->get('/admin/security-object')->assertOk();
        $this->actingAs($admin)->get('/admin/security-permission')->assertOk();
    }

    public function test_edit_endpoint_returns_the_row_as_json(): void
    {
        $admin = $this->makeAdmin();
        $object = SecurityObject::where('name', 'admin')->firstOrFail();

        $this->actingAs($admin)
            ->get('/admin/security-object/edit/' . $object->id)
            ->assertOk()
            ->assertJsonPath('model.id', $object->id)
            ->assertJsonPath('model.name', 'admin');
    }

    public function test_delete_endpoint_removes_the_row(): void
    {
        $admin = $this->makeAdmin();

        $permission = new SecurityPermission();
        $permission->name = 'Temp';
        $permission->description = 'temporary';
        $permission->save();

        $this->actingAs($admin)
            ->get('/admin/security-permission/delete/' . $permission->id);

        $this->assertDatabaseMissing('security_permissions', ['id' => $permission->id]);
    }
}
