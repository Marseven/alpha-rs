<?php

namespace Tests\Feature\Workflow;

use App\Models\MedicalCaseStatusHistory;
use App\Models\MedicalCaseWorkflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

class MedicalWorkflowTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    // ---- Doctor ----

    public function test_doctor_sees_only_their_cases(): void
    {
        $doctor = $this->makeDoctor();
        $other = $this->makeDoctor();
        $mine = $this->makeCase(['doctor_id' => $doctor->id]);
        $theirs = $this->makeCase(['doctor_id' => $other->id]);

        $this->actingAs($doctor)->get('/doctor/cases')->assertOk();
        $this->actingAs($doctor)->get('/doctor/cases/' . $mine->id)->assertOk();
        $this->actingAs($doctor)->get('/doctor/cases/' . $theirs->id)->assertForbidden();
    }

    public function test_non_doctor_cannot_access_doctor_space(): void
    {
        $client = $this->makeUser();
        $this->actingAs($client)->get('/doctor/cases')->assertForbidden();
    }

    public function test_doctor_can_send_assigned_case_to_pharmacy(): void
    {
        $doctor = $this->makeDoctor();
        $pharmacy = $this->makePharmacy();
        $case = $this->makeCase(['doctor_id' => $doctor->id]);

        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/send-to-pharmacy', ['pharmacy_id' => $pharmacy->id])
            ->assertRedirect();

        $case->refresh();
        $this->assertSame(MedicalCaseWorkflow::SENT_TO_PHARMACY, $case->status);
        $this->assertSame($pharmacy->id, (int) $case->pharmacy_id);
        $this->assertNotNull($case->sent_to_pharmacy_at);
        $this->assertDatabaseHas('medical_case_status_histories', [
            'medical_case_workflow_id' => $case->id,
            'new_status' => MedicalCaseWorkflow::SENT_TO_PHARMACY,
        ]);
    }

    public function test_doctor_cannot_send_a_case_that_is_not_theirs(): void
    {
        $doctor = $this->makeDoctor();
        $other = $this->makeDoctor();
        $pharmacy = $this->makePharmacy();
        $case = $this->makeCase(['doctor_id' => $other->id]);

        $this->actingAs($doctor)
            ->post('/doctor/cases/' . $case->id . '/send-to-pharmacy', ['pharmacy_id' => $pharmacy->id])
            ->assertForbidden();

        $this->assertSame(MedicalCaseWorkflow::DRAFT, $case->fresh()->status);
    }

    // ---- Pharmacy (CNAMGS) ----

    public function test_pharmacy_sees_only_cases_sent_to_them(): void
    {
        $pharmacy = $this->makePharmacy();
        $other = $this->makePharmacy();
        $mine = $this->makeCase(['pharmacy_id' => $pharmacy->id, 'status' => MedicalCaseWorkflow::SENT_TO_PHARMACY]);
        $theirs = $this->makeCase(['pharmacy_id' => $other->id, 'status' => MedicalCaseWorkflow::SENT_TO_PHARMACY]);

        $this->actingAs($pharmacy)->get('/pharmacy/cases/' . $mine->id)->assertOk();
        $this->actingAs($pharmacy)->get('/pharmacy/cases/' . $theirs->id)->assertForbidden();
    }

    public function test_pharmacy_can_update_status_and_history_is_recorded(): void
    {
        $pharmacy = $this->makePharmacy();
        $case = $this->makeCase(['pharmacy_id' => $pharmacy->id, 'status' => MedicalCaseWorkflow::SENT_TO_PHARMACY]);

        $this->actingAs($pharmacy)
            ->post('/pharmacy/cases/' . $case->id . '/update-status', [
                'status' => MedicalCaseWorkflow::IN_REVIEW,
                'pharmacy_note' => 'Traitement en cours',
            ])->assertRedirect();

        $case->refresh();
        $this->assertSame(MedicalCaseWorkflow::IN_REVIEW, $case->status);
        $this->assertSame(1, MedicalCaseStatusHistory::where('medical_case_workflow_id', $case->id)
            ->where('new_status', MedicalCaseWorkflow::IN_REVIEW)->count());
    }

    public function test_pharmacy_cannot_set_an_invalid_status(): void
    {
        $pharmacy = $this->makePharmacy();
        $case = $this->makeCase(['pharmacy_id' => $pharmacy->id, 'status' => MedicalCaseWorkflow::SENT_TO_PHARMACY]);

        $this->actingAs($pharmacy)
            ->post('/pharmacy/cases/' . $case->id . '/update-status', ['status' => 'hacked'])
            ->assertSessionHasErrors('status');
    }
}
