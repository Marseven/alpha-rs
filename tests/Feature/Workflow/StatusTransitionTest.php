<?php

namespace Tests\Feature\Workflow;

use App\Models\MedicalCaseWorkflow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Security\CreatesDomainData;
use Tests\TestCase;

/**
 * The workflow had no state machine: any status could be set from any other, so
 * a COMPLETED or CANCELLED case could be dragged back to an earlier step and a
 * case could jump straight to COMPLETED without ever being instructed.
 */
class StatusTransitionTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_forward_transitions_are_allowed(): void
    {
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::RECEIVED_BY_CNAMGS]);

        $case->changeStatus(MedicalCaseWorkflow::IN_REVIEW);
        $this->assertSame(MedicalCaseWorkflow::IN_REVIEW, $case->fresh()->status);

        $case->changeStatus(MedicalCaseWorkflow::READY);
        $this->assertSame(MedicalCaseWorkflow::READY, $case->fresh()->status);

        $case->changeStatus(MedicalCaseWorkflow::COMPLETED);
        $this->assertSame(MedicalCaseWorkflow::COMPLETED, $case->fresh()->status);
    }

    public function test_a_completed_case_cannot_go_backwards(): void
    {
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::COMPLETED]);

        $this->expectException(\DomainException::class);
        $case->changeStatus(MedicalCaseWorkflow::IN_REVIEW);
    }

    public function test_a_cancelled_case_is_terminal(): void
    {
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::CANCELLED]);

        $this->assertTrue($case->isTerminal());
        $this->assertSame([], $case->allowedTransitions());

        $this->expectException(\DomainException::class);
        $case->changeStatus(MedicalCaseWorkflow::READY);
    }

    public function test_a_case_cannot_jump_straight_to_completed(): void
    {
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::IN_REVIEW]);

        $this->assertFalse($case->canTransitionTo(MedicalCaseWorkflow::COMPLETED));

        $this->expectException(\DomainException::class);
        $case->changeStatus(MedicalCaseWorkflow::COMPLETED);
    }

    public function test_a_case_cannot_return_to_draft(): void
    {
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::IN_REVIEW]);

        $this->expectException(\DomainException::class);
        $case->changeStatus(MedicalCaseWorkflow::DRAFT);
    }

    public function test_missing_information_can_go_back_to_review(): void
    {
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::MISSING_INFORMATION]);

        $case->changeStatus(MedicalCaseWorkflow::IN_REVIEW);

        $this->assertSame(MedicalCaseWorkflow::IN_REVIEW, $case->fresh()->status);
    }

    public function test_restating_the_same_status_is_allowed(): void
    {
        $case = $this->makeCase(['status' => MedicalCaseWorkflow::IN_REVIEW]);

        $case->changeStatus(MedicalCaseWorkflow::IN_REVIEW, null, 'note mise à jour');

        $this->assertSame(MedicalCaseWorkflow::IN_REVIEW, $case->fresh()->status);
    }

    public function test_cnamgs_cannot_post_a_forbidden_transition(): void
    {
        $cnamgs = $this->makeCnamgs();
        $case = $this->makeCase([
            'status' => MedicalCaseWorkflow::COMPLETED,
            'cnamgs_id' => $cnamgs->id,
        ]);

        $this->actingAs($cnamgs)
            ->post(route('cnamgs.cases.status', $case), [
                'status' => MedicalCaseWorkflow::IN_REVIEW,
            ])
            ->assertSessionHasErrors('status');

        $this->assertSame(MedicalCaseWorkflow::COMPLETED, $case->fresh()->status);
    }
}
