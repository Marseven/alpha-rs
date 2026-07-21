<?php

namespace Tests\Feature\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Suspension is the reversible alternative to deleting a staff account (which
 * would orphan the cases they handled). A suspended account must lose access
 * both at login and mid-session, and must be reversible.
 */
class StaffSuspensionTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_suspended_doctor_cannot_log_in_even_with_valid_credentials(): void
    {
        $doctor = $this->makeUser([
            'email' => 'doc@example.test',
            'password' => 'secret1234',
            'workflow_role' => 'doctor',
        ]);
        $doctor->suspended_at = now();
        $doctor->save();

        $this->post('/login', ['email' => 'doc@example.test', 'password' => 'secret1234'])
            ->assertRedirect()
            ->assertSessionHas('error');

        $this->assertGuest();
    }

    public function test_suspended_doctor_is_kicked_out_of_an_active_session(): void
    {
        $doctor = $this->makeDoctor();

        // Already authenticated, then suspended by an admin.
        $this->actingAs($doctor);
        $doctor->suspended_at = now();
        $doctor->save();

        $this->get('/doctor/cases')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_active_doctor_still_reaches_their_space(): void
    {
        $this->actingAs($this->makeDoctor())
            ->get('/doctor/cases')
            ->assertOk();
    }

    public function test_admin_can_suspend_and_reactivate_a_staff_account(): void
    {
        $admin = $this->makeAdmin();
        $doctor = $this->makeDoctor();

        $this->actingAs($admin)
            ->post('/admin/staff/' . $doctor->id, ['suspend' => '1'])
            ->assertRedirect();
        $this->assertNotNull($doctor->fresh()->suspended_at);

        $this->actingAs($admin)
            ->post('/admin/staff/' . $doctor->id, ['reactivate' => '1'])
            ->assertRedirect();
        $this->assertNull($doctor->fresh()->suspended_at);
    }

    public function test_staff_can_be_created_with_medical_profile_fields(): void
    {
        $this->actingAs($this->makeAdmin())
            ->post('/admin/staff', [
                'name' => 'Dr House',
                'email' => 'house@example.test',
                'phone' => '074000000',
                'workflow_role' => 'doctor',
                'password' => 'secret1234',
                'specialty' => 'Cardiologie',
                'institution' => 'CHU Libreville',
                'license_number' => 'GA-12345',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('users', [
            'email' => 'house@example.test',
            'specialty' => 'Cardiologie',
            'institution' => 'CHU Libreville',
            'license_number' => 'GA-12345',
        ]);
    }
}
