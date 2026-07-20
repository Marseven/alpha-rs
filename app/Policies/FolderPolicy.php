<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\MedicalCaseWorkflow;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * A client may only act on their own folders — plus the medical reviewer
     * actually assigned to the case built on that folder (see below).
     */
    public function view(User $user, Folder $folder): bool
    {
        return $this->owns($user, $folder) || $this->isAssignedMedicalReviewer($user, $folder);
    }

    /**
     * Need-to-know access for the medical space: the doctor / CNAMGS agent a
     * case is assigned to must be able to read that case's attachment, and only
     * that one. Read-only — pay() and update() stay owner-only.
     *
     * Before this, the doctor/CNAMGS views linked straight to the raw
     * join_piece column value, which bypassed authentication entirely for
     * legacy public files (and was simply broken for private ones).
     */
    private function isAssignedMedicalReviewer(User $user, Folder $folder): bool
    {
        return MedicalCaseWorkflow::where('folder_id', $folder->id)
            ->where(function ($query) use ($user) {
                $query->where('doctor_id', $user->id)->orWhere('cnamgs_id', $user->id);
            })
            ->exists();
    }

    public function pay(User $user, Folder $folder): bool
    {
        return $this->owns($user, $folder);
    }

    public function update(User $user, Folder $folder): bool
    {
        return $this->owns($user, $folder);
    }

    private function owns(User $user, Folder $folder): bool
    {
        return (int) $folder->user_id === (int) $user->id;
    }
}
