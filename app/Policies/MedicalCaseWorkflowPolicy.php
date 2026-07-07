<?php

namespace App\Policies;

use App\Models\MedicalCaseWorkflow;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Access rules for medical case workflows.
 * (Platform admins bypass every ability via Gate::before in AuthServiceProvider.)
 */
class MedicalCaseWorkflowPolicy
{
    use HandlesAuthorization;

    /** Doctor sees only their cases; cnamgs sees only cases sent to them. */
    public function view(User $user, MedicalCaseWorkflow $case): bool
    {
        return $this->ownsAsDoctor($user, $case) || $this->ownsAsCnamgs($user, $case);
    }

    /** Only the assigned doctor may send, and only from a sendable status. */
    public function sendToCnamgs(User $user, MedicalCaseWorkflow $case): bool
    {
        return $this->ownsAsDoctor($user, $case)
            && in_array($case->status, [MedicalCaseWorkflow::DRAFT, MedicalCaseWorkflow::MISSING_INFORMATION], true);
    }

    /** Only the receiving cnamgs may update status, once the case was sent. */
    public function updateStatus(User $user, MedicalCaseWorkflow $case): bool
    {
        return $this->ownsAsCnamgs($user, $case)
            && $case->status !== MedicalCaseWorkflow::DRAFT;
    }

    /** Any doctor may register a new case (dossier). */
    public function create(User $user): bool
    {
        return $user->isDoctor();
    }

    /** A doctor may edit their own case while it is still editable (not yet in CNAMGS review). */
    public function update(User $user, MedicalCaseWorkflow $case): bool
    {
        return $this->ownsAsDoctor($user, $case)
            && in_array($case->status, [MedicalCaseWorkflow::DRAFT, MedicalCaseWorkflow::MISSING_INFORMATION], true);
    }

    /** A doctor may delete their own case only while it is still a draft (never sent). */
    public function delete(User $user, MedicalCaseWorkflow $case): bool
    {
        return $this->ownsAsDoctor($user, $case)
            && $case->status === MedicalCaseWorkflow::DRAFT;
    }

    private function ownsAsDoctor(User $user, MedicalCaseWorkflow $case): bool
    {
        return $user->isDoctor() && (int) $case->doctor_id === (int) $user->id;
    }

    private function ownsAsCnamgs(User $user, MedicalCaseWorkflow $case): bool
    {
        return $user->isCnamgs() && (int) $case->cnamgs_id === (int) $user->id;
    }
}
