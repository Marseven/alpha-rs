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

    /** Doctor sees only their cases; pharmacy sees only cases sent to them. */
    public function view(User $user, MedicalCaseWorkflow $case): bool
    {
        return $this->ownsAsDoctor($user, $case) || $this->ownsAsPharmacy($user, $case);
    }

    /** Only the assigned doctor may send, and only from a sendable status. */
    public function sendToPharmacy(User $user, MedicalCaseWorkflow $case): bool
    {
        return $this->ownsAsDoctor($user, $case)
            && in_array($case->status, [MedicalCaseWorkflow::DRAFT, MedicalCaseWorkflow::MISSING_INFORMATION], true);
    }

    /** Only the receiving pharmacy may update status, once the case was sent. */
    public function updateStatus(User $user, MedicalCaseWorkflow $case): bool
    {
        return $this->ownsAsPharmacy($user, $case)
            && $case->status !== MedicalCaseWorkflow::DRAFT;
    }

    private function ownsAsDoctor(User $user, MedicalCaseWorkflow $case): bool
    {
        return $user->isDoctor() && (int) $case->doctor_id === (int) $user->id;
    }

    private function ownsAsPharmacy(User $user, MedicalCaseWorkflow $case): bool
    {
        return $user->isPharmacy() && (int) $case->pharmacy_id === (int) $user->id;
    }
}
