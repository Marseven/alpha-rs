<?php

namespace Tests\Feature\Security;

use App\Models\SecurityRole;
use App\Services\Rbac;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RbacTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    private function roleUser(): array
    {
        $role = new SecurityRole();
        $role->name = 'Gestionnaire';
        $role->security_object_id = 1;
        $role->save();

        return [$role, $this->makeUser(['security_role_id' => $role->id])];
    }

    private function grant(int $roleId, string $object, array $flags): void
    {
        $permId = DB::table('security_permissions')->insertGetId(['name' => $object, 'description' => $object]);
        DB::table('security_role_permission')->insert(array_merge([
            'security_role_id' => $roleId,
            'security_permission_id' => $permId,
        ], $flags));
    }

    public function test_unconfigured_role_has_full_access(): void
    {
        [, $user] = $this->roleUser();

        $this->assertTrue(Rbac::allows($user, 'Quotes', 'look'));
        $this->assertTrue(Rbac::allows($user, 'Hospitals', 'del'));
    }

    public function test_configured_role_is_fail_safe_and_case_insensitive(): void
    {
        [$role, $user] = $this->roleUser();
        $this->grant($role->id, 'Hospitals', ['look' => 'on', 'updat' => 'on', 'creat' => null, 'del' => null]);

        // case-insensitive match + granted flag
        $this->assertTrue(Rbac::allows($user, 'hospitals', 'updat'));
        $this->assertTrue(Rbac::allows($user, 'Hospitals', 'look'));
        // flag not "on" => denied
        $this->assertFalse(Rbac::allows($user, 'Hospitals', 'del'));
        // object with no permission row => fail-safe deny (was fail-open before)
        $this->assertFalse(Rbac::allows($user, 'Quotes', 'updat'));
    }

    public function test_null_user_is_denied(): void
    {
        $this->assertFalse(Rbac::allows(null, 'Quotes', 'look'));
    }
}
