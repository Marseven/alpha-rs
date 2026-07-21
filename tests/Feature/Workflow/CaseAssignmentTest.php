<?php

namespace Tests\Feature\Workflow;

use App\Models\MedicalCaseWorkflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

/**
 * Third-party assignment: Relief Services (admin) can assign / reassign a case
 * to a doctor and set a deadline. Reassignment requires a reason; every change
 * is recorded in the case history.
 */
class CaseAssignmentTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_admin_assigns_an_unassigned_case_to_a_doctor(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::DRAFT]);

        $this->actingAs($this->makeAdmin())
            ->post(route('admin.medical-cases.assign', $case), [
                'doctor_id' => $doctor->id,
                'due_at' => now()->addDays(5)->format('Y-m-d'),
            ])
            ->assertRedirect();

        $case->refresh();
        $this->assertSame($doctor->id, (int) $case->doctor_id);
        $this->assertNotNull($case->due_at);
        $this->assertNotNull($case->assigned_at);
        $this->assertDatabaseHas('medical_case_status_histories', [
            'medical_case_workflow_id' => $case->id,
        ]);
    }

    public function test_reassignment_requires_a_reason(): void
    {
        $admin = $this->makeAdmin(); // one admin, reused (avoid duplicate 'admin' objects)
        $first = $this->makeDoctor();
        $second = $this->makeDoctor();
        $case = $this->makeCase(['doctor_id' => $first->id, 'status' => MedicalCaseWorkflow::DRAFT]);

        // No reason → refused, doctor unchanged.
        $this->actingAs($admin)
            ->post(route('admin.medical-cases.assign', $case), ['doctor_id' => $second->id])
            ->assertSessionHasErrors('reason');
        $this->assertSame($first->id, (int) $case->fresh()->doctor_id);

        // With a reason → accepted.
        $this->actingAs($admin)
            ->post(route('admin.medical-cases.assign', $case), [
                'doctor_id' => $second->id,
                'reason' => 'Spécialité plus adaptée.',
            ])
            ->assertRedirect();
        $this->assertSame($second->id, (int) $case->fresh()->doctor_id);
    }

    public function test_a_suspended_doctor_cannot_receive_a_case(): void
    {
        $doctor = $this->makeDoctor();
        $doctor->suspended_at = now();
        $doctor->save();
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::DRAFT]);

        $this->actingAs($this->makeAdmin())
            ->post(route('admin.medical-cases.assign', $case), ['doctor_id' => $doctor->id])
            ->assertRedirect()
            ->assertSessionHas('error');

        $this->assertNull($case->fresh()->doctor_id);
    }

    public function test_a_closed_case_cannot_be_assigned(): void
    {
        $doctor = $this->makeDoctor();
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::COMPLETED]);

        $this->actingAs($this->makeAdmin())
            ->post(route('admin.medical-cases.assign', $case), ['doctor_id' => $doctor->id])
            ->assertRedirect()
            ->assertSessionHas('error');

        $this->assertNull($case->fresh()->doctor_id);
    }

    public function test_a_non_doctor_cannot_be_assigned(): void
    {
        $cnamgs = $this->makeCnamgs();
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::DRAFT]);

        $this->actingAs($this->makeAdmin())
            ->post(route('admin.medical-cases.assign', $case), ['doctor_id' => $cnamgs->id])
            ->assertSessionHasErrors('doctor_id');
    }

    public function test_overdue_flag_reflects_the_deadline(): void
    {
        $past = $this->makeCase(['status' => MedicalCaseWorkflow::IN_REVIEW, 'due_at' => now()->subDay()]);
        $future = $this->makeCase(['status' => MedicalCaseWorkflow::IN_REVIEW, 'due_at' => now()->addDay()]);
        $closed = $this->makeCase(['status' => MedicalCaseWorkflow::COMPLETED, 'due_at' => now()->subDay()]);

        $this->assertTrue($past->isOverdue());
        $this->assertFalse($future->isOverdue());
        // A closed case is never overdue, even past its deadline.
        $this->assertFalse($closed->isOverdue());
    }

    public function test_a_regular_doctor_cannot_reach_the_admin_assignment_screen(): void
    {
        // The IsAdmin middleware redirects non-admins away from the back-office.
        $this->actingAs($this->makeDoctor())
            ->get(route('admin.medical-cases'))
            ->assertRedirect('/');
    }

    public function test_admin_screen_renders_cases_with_the_overdue_badge(): void
    {
        $doctor = $this->makeDoctor();
        $overdue = $this->makeCase([
            'patient_name' => 'Paul Obiang',
            'doctor_id' => $doctor->id,
            'status' => MedicalCaseWorkflow::IN_REVIEW,
            'due_at' => now()->subDays(2),
        ]);

        $this->actingAs($this->makeAdmin())
            ->get(route('admin.medical-cases'))
            ->assertOk()
            ->assertSee($overdue->tracking_number)
            ->assertSee('Paul Obiang')
            ->assertSee('En retard');
    }
}
