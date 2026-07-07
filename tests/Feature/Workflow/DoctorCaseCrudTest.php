<?php

namespace Tests\Feature\Workflow;

use App\Models\MedicalCaseWorkflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

/**
 * End-to-end coverage of the doctor space: create / edit / delete a case,
 * ownership + status guards, sending to CNAMGS, and role isolation.
 */
class DoctorCaseCrudTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_doctor_can_open_the_space_and_the_create_form(): void
    {
        $doctor = $this->makeDoctor();

        $this->actingAs($doctor)->get('/doctor/cases')->assertOk();
        $this->actingAs($doctor)->get('/doctor/cases/create')->assertOk();
    }

    public function test_doctor_can_create_a_draft_case_assigned_to_them(): void
    {
        $doctor = $this->makeDoctor();

        $this->actingAs($doctor)
            ->post('/doctor/cases', [
                'patient_name' => 'Awa Ndong',
                'patient_phone' => '077112233',
                'doctor_note' => 'Évacuation cardiologie',
            ])
            ->assertRedirect();

        $case = MedicalCaseWorkflow::first();
        $this->assertNotNull($case);
        $this->assertSame('Awa Ndong', $case->patient_name);
        $this->assertSame($doctor->id, (int) $case->doctor_id);
        $this->assertSame(MedicalCaseWorkflow::DRAFT, $case->status);
        $this->assertNotEmpty($case->tracking_number); // RS-XXXXXX auto-generated
    }

    public function test_create_requires_patient_fields(): void
    {
        $this->actingAs($this->makeDoctor())
            ->from('/doctor/cases/create')
            ->post('/doctor/cases', [])
            ->assertSessionHasErrors(['patient_name', 'patient_phone']);

        $this->assertSame(0, MedicalCaseWorkflow::count());
    }

    public function test_doctor_can_edit_their_own_editable_case(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $doctor->id]);

        $this->actingAs($doctor)
            ->put('/doctor/cases/' . $case->id, [
                'patient_name' => 'Nom Modifié',
                'patient_phone' => '066998877',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('medical_case_workflows', [
            'id' => $case->id,
            'patient_name' => 'Nom Modifié',
            'patient_phone' => '066998877',
        ]);
    }

    public function test_doctor_can_delete_their_own_draft_case(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $doctor->id]);

        $this->actingAs($doctor)
            ->delete('/doctor/cases/' . $case->id)
            ->assertRedirect('/doctor/cases');

        $this->assertDatabaseMissing('medical_case_workflows', ['id' => $case->id]);
    }

    public function test_doctor_cannot_touch_another_doctors_case(): void
    {
        $owner = $this->makeDoctor();
        $intruder = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $owner->id]);

        $this->actingAs($intruder)->get('/doctor/cases/' . $case->id)->assertForbidden();
        $this->actingAs($intruder)->get('/doctor/cases/' . $case->id . '/edit')->assertForbidden();
        $this->actingAs($intruder)->put('/doctor/cases/' . $case->id, ['patient_name' => 'x', 'patient_phone' => 'y'])->assertForbidden();
        $this->actingAs($intruder)->delete('/doctor/cases/' . $case->id)->assertForbidden();

        $this->assertDatabaseHas('medical_case_workflows', ['id' => $case->id, 'patient_name' => 'Jean Dupont']);
    }

    public function test_doctor_cannot_delete_a_case_already_sent_to_cnamgs(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $doctor->id, 'status' => MedicalCaseWorkflow::SENT_TO_CNAMGS]);

        $this->actingAs($doctor)->delete('/doctor/cases/' . $case->id)->assertForbidden();
        $this->assertDatabaseHas('medical_case_workflows', ['id' => $case->id]);
    }

    public function test_doctor_can_send_a_draft_case_to_cnamgs(): void
    {
        $doctor = $this->makeDoctor();
        $cnamgs = $this->makeUser(['workflow_role' => 'cnamgs']);
        $case = $this->makeCase(['doctor_id' => $doctor->id]);

        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/send-to-cnamgs', ['cnamgs_id' => $cnamgs->id])
            ->assertRedirect();

        $this->assertDatabaseHas('medical_case_workflows', [
            'id' => $case->id,
            'status' => MedicalCaseWorkflow::SENT_TO_CNAMGS,
            'cnamgs_id' => $cnamgs->id,
        ]);
    }

    public function test_non_doctor_cannot_access_the_doctor_space(): void
    {
        $user = $this->makeUser(); // no workflow_role

        $this->actingAs($user)->get('/doctor/cases')->assertForbidden();
        $this->actingAs($user)->get('/doctor/cases/create')->assertForbidden();
    }
}
