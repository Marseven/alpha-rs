<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * Assign a workflow role to a user (data migration / administration).
 *
 * Usage:
 *   php artisan users:set-role medecin@example.com doctor
 *   php artisan users:set-role cnamgs@example.com pharmacy
 *   php artisan users:set-role admin@example.com admin
 *   php artisan users:set-role someone@example.com none   # clear the role
 */
class SetUserWorkflowRole extends Command
{
    protected $signature = 'users:set-role {email} {role}';

    protected $description = 'Set (or clear) the workflow role of a user by email (doctor|pharmacy|admin|none)';

    public function handle(): int
    {
        $email = $this->argument('email');
        $role = strtolower($this->argument('role'));

        if (! in_array($role, ['doctor', 'pharmacy', 'admin', 'none'], true)) {
            $this->error('Role invalide. Valeurs : doctor, pharmacy, admin, none.');
            return self::FAILURE;
        }

        $user = User::where('email', $email)->first();
        if (! $user) {
            $this->error("Aucun utilisateur avec l'email {$email}.");
            return self::FAILURE;
        }

        $user->workflow_role = $role === 'none' ? null : $role;
        $user->save();

        $this->info("{$user->name} ({$email}) -> workflow_role = " . ($user->workflow_role ?? 'null'));

        return self::SUCCESS;
    }
}
