<?php

namespace Tests\Feature\Security;

use App\Models\Folder;
use App\Models\SecurityObject;
use App\Models\SecurityRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Several back-office write endpoints were reachable by ANY operator who got
 * past the coarse `admin` middleware, with no fine-grained he_can() check:
 *
 *  - POST admin/register and POST admin/admin-user/{user} both assign
 *    security_role_id, so a restricted operator could grant themselves (or
 *    anyone) the admin role — a straight privilege escalation.
 *  - POST admin/folder-state/{folder} changed a client's status AND price and
 *    mailed them, unvalidated and ungated.
 *  - POST admin/admin-userpassword/{user} was dead code that wrote an arbitrary
 *    `status` onto any user.
 *
 * These tests lock the fix: an operator whose role IS configured but lacks the
 * relevant permission must be refused (Rbac is fail-safe).
 */
class BackofficePrivilegeEscalationTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    /**
     * An operator that reaches the admin space (role -> "admin" security object)
     * but whose role is configured WITHOUT the given object's permissions.
     */
    private function restrictedOperator(): User
    {
        // These legacy models have no $fillable: build them attribute by
        // attribute, like CreatesDomainData does.
        $object = SecurityObject::where('name', 'admin')->first();
        if (! $object) {
            $object = new SecurityObject();
            $object->name = 'admin';
            $object->url = '/admin';
            $object->icon = 'icon';
            $object->enable = '1';
            $object->save();
        }

        $role = new SecurityRole();
        $role->name = 'Opérateur restreint';
        $role->security_object_id = $object->id;
        $role->save();

        // The role IS configured (one unrelated permission) => Rbac becomes
        // fail-safe and denies everything not explicitly granted.
        $permId = DB::table('security_permissions')->insertGetId([
            'name' => 'Quotes', 'description' => 'Quotes',
        ]);
        DB::table('security_role_permission')->insert([
            'security_role_id' => $role->id,
            'security_permission_id' => $permId,
            'look' => 'on',
        ]);

        return $this->makeUser(['security_role_id' => $role->id]);
    }

    public function test_restricted_operator_cannot_change_a_users_security_role(): void
    {
        $victim = $this->makeUser();
        $originalRole = $victim->security_role_id;

        $this->actingAs($this->restrictedOperator())
            ->post('/admin/admin-user/' . $victim->id, [
                'name' => 'Escalated',
                'email' => $victim->email,
                'phone' => '074010203',
                'security_role_id' => 1, // tries to grab the admin role
            ])
            ->assertForbidden();

        $victim->refresh();
        $this->assertSame($originalRole, $victim->security_role_id);
    }

    public function test_restricted_operator_cannot_create_a_user(): void
    {
        $this->actingAs($this->restrictedOperator())
            ->post('/admin/register', [
                'name' => 'New Admin',
                'email' => 'new-admin@example.test',
                'phone' => '074010203',
                'security_role_id' => 1,
            ])
            ->assertForbidden();

        $this->assertDatabaseMissing('users', ['email' => 'new-admin@example.test']);
    }

    public function test_restricted_operator_cannot_delete_a_user(): void
    {
        $victim = $this->makeUser();

        $this->actingAs($this->restrictedOperator())
            ->post('/admin/admin-user/' . $victim->id, ['delete' => '1'])
            ->assertForbidden();

        $this->assertDatabaseHas('users', ['id' => $victim->id]);
    }

    public function test_restricted_operator_cannot_change_a_folder_state_or_price(): void
    {
        Mail::fake();
        $folder = $this->makeFolder($this->makeUser());

        $this->actingAs($this->restrictedOperator())
            ->post('/admin/folder-state/' . $folder->id, [
                'status' => 2,
                'price' => 1,
            ])
            ->assertForbidden();

        $folder->refresh();
        $this->assertSame(0, (int) $folder->status);
        Mail::assertNothingQueued();
    }

    public function test_folder_state_rejects_an_out_of_range_status(): void
    {
        Mail::fake();
        $folder = $this->makeFolder($this->makeUser());

        $this->actingAs($this->makeAdmin())
            ->post('/admin/folder-state/' . $folder->id, [
                'status' => 99, // not offered by work_status()
                'price' => 1000,
            ])
            ->assertSessionHasErrors('status');

        $folder->refresh();
        $this->assertSame(0, (int) $folder->status);
    }

    public function test_dead_admin_userpassword_route_is_removed(): void
    {
        $victim = $this->makeUser();

        $this->actingAs($this->makeAdmin())
            ->post('/admin/admin-userpassword/' . $victim->id, ['status' => 8])
            ->assertNotFound();
    }
}
