<?php

namespace App\Providers;

use App\Models\SecurityObject;
use App\Models\SecurityRole;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Quote::class => \App\Policies\QuotePolicy::class,
        \App\Models\Folder::class => \App\Policies\FolderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Back-office users (role mapped to the "admin" security object) are
        // granted every ability, so admins can manage/download any resource
        // while clients remain restricted to their own (see Quote/FolderPolicy).
        Gate::before(function (User $user, string $ability) {
            return $this->isAdmin($user) ? true : null;
        });
    }

    private function isAdmin(User $user): bool
    {
        if (! $user->security_role_id) {
            return false;
        }

        $role = SecurityRole::find($user->security_role_id);
        if (! $role) {
            return false;
        }

        $object = SecurityObject::find($role->security_object_id);

        return $object && strtolower((string) $object->name) === 'admin';
    }
}
