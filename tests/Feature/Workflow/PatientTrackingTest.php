<?php

namespace Tests\Feature\Workflow;

use App\Models\MedicalCaseWorkflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

class PatientTrackingTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_public_track_page_is_reachable(): void
    {
        $this->get('/track-case')->assertOk();
    }

    public function test_patient_can_track_with_correct_number_and_phone(): void
    {
        $case = $this->makeCase([
            'patient_phone' => '077123456',
            'status' => MedicalCaseWorkflow::IN_REVIEW,
        ]);

        $this->post('/track-case', [
            'tracking_number' => $case->tracking_number,
            'phone' => '077123456',
        ])->assertOk()->assertSee('en cours de traitement', false);
    }

    public function test_wrong_phone_reveals_nothing(): void
    {
        $case = $this->makeCase(['patient_phone' => '077123456']);

        $response = $this->post('/track-case', [
            'tracking_number' => $case->tracking_number,
            'phone' => '000000000',
        ]);

        $response->assertSessionHas('error');
    }

    public function test_public_page_never_exposes_documents_or_internal_notes(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase([
            'patient_phone' => '077123456',
            'doctor_id' => $doctor->id,
            'doctor_note' => 'SECRET-DOCTOR-NOTE',
            'pharmacy_note' => 'SECRET-PHARMACY-NOTE',
            'status' => MedicalCaseWorkflow::IN_REVIEW,
        ]);

        $html = $this->post('/track-case', [
            'tracking_number' => $case->tracking_number,
            'phone' => '077123456',
        ])->assertOk()->getContent();

        $this->assertStringNotContainsString('SECRET-DOCTOR-NOTE', $html);
        $this->assertStringNotContainsString('SECRET-PHARMACY-NOTE', $html);
    }
}
