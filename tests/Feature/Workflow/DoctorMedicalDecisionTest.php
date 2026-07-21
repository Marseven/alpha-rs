<?php

namespace Tests\Feature\Workflow;

use App\Models\MedicalCaseStatusHistory;
use App\Models\MedicalCaseWorkflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

/**
 * The doctor's medical decisions: validate (send with a mandatory opinion),
 * reject, and request more information — each with a mandatory reason recorded
 * in the case history. Before this the doctor could only create/edit/delete a
 * draft and send.
 */
class DoctorMedicalDecisionTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_validation_requires_a_medical_opinion(): void
    {
        $doctor = $this->makeDoctor();
        $cnamgs = $this->makeCnamgs();
        $case = $this->makeCase(['doctor_id' => $doctor->id, 'status' => MedicalCaseWorkflow::DRAFT]);

        // No doctor_note → validation refused.
        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/send-to-cnamgs', ['cnamgs_id' => $cnamgs->id])
            ->assertSessionHasErrors('doctor_note');

        $this->assertSame(MedicalCaseWorkflow::DRAFT, $case->fresh()->status);
    }

    public function test_doctor_rejects_a_case_with_a_reason(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $doctor->id, 'status' => MedicalCaseWorkflow::DRAFT]);

        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/reject', ['reason' => 'Contre-indication médicale.'])
            ->assertRedirect();

        $this->assertSame(MedicalCaseWorkflow::CANCELLED, $case->fresh()->status);
        $this->assertDatabaseHas('medical_case_status_histories', [
            'medical_case_workflow_id' => $case->id,
            'new_status' => MedicalCaseWorkflow::CANCELLED,
        ]);
    }

    public function test_rejection_requires_a_reason(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $doctor->id, 'status' => MedicalCaseWorkflow::DRAFT]);

        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/reject', [])
            ->assertSessionHasErrors('reason');

        $this->assertSame(MedicalCaseWorkflow::DRAFT, $case->fresh()->status);
    }

    public function test_doctor_requests_more_information(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $doctor->id, 'status' => MedicalCaseWorkflow::DRAFT]);

        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/request-information', ['reason' => 'Compte-rendu opératoire manquant.'])
            ->assertRedirect();

        $this->assertSame(MedicalCaseWorkflow::MISSING_INFORMATION, $case->fresh()->status);
    }

    public function test_doctor_can_revalidate_after_the_complement_is_provided(): void
    {
        $doctor = $this->makeDoctor();
        $cnamgs = $this->makeCnamgs();
        // Case bounced to missing_information; the doctor now re-transmits.
        $case = $this->makeCase(['doctor_id' => $doctor->id, 'status' => MedicalCaseWorkflow::MISSING_INFORMATION]);

        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/send-to-cnamgs', [
                'cnamgs_id' => $cnamgs->id,
                'doctor_note' => 'Complément reçu, avis favorable.',
            ])
            ->assertRedirect();

        $this->assertSame(MedicalCaseWorkflow::SENT_TO_CNAMGS, $case->fresh()->status);
    }

    public function test_a_doctor_cannot_decide_on_a_case_that_is_not_theirs(): void
    {
        $case = $this->makeCase(['doctor_id' => $this->makeDoctor()->id, 'status' => MedicalCaseWorkflow::DRAFT]);

        $this->actingAs($this->makeDoctor())
            ->post('/doctor/cases/' . $case->id . '/reject', ['reason' => 'x'])
            ->assertForbidden();
    }

    public function test_a_sent_case_can_no_longer_be_rejected_by_the_doctor(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $doctor->id, 'status' => MedicalCaseWorkflow::SENT_TO_CNAMGS]);

        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/reject', ['reason' => 'trop tard'])
            ->assertForbidden();
    }
}
