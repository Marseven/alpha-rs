<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * A client may only act on their own folders.
     */
    public function view(User $user, Folder $folder): bool
    {
        return $this->owns($user, $folder);
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
