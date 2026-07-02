<?php

namespace App\Services;

use App\Models\User;

/**
 * Fine-grained back-office permission checks (security_role_permission).
 *
 * Model: every back-office user maps to the "admin" security object (entry is
 * gated by the IsAdmin middleware); roles are differentiated by their
 * fine-grained permissions.
 *
 * Rules:
 *  - a role with NO permissions configured = full access (backward compatible;
 *    avoids locking out the existing unconfigured admin role);
 *  - a role WITH permissions = fail-safe: an action is allowed only if that
 *    object's flag is explicitly "on" (the old version allowed access when no
 *    matching permission row was found — a fail-open hole);
 *  - object names are matched case-insensitively ('hospitals' == 'Hospitals');
 *  - permissions are loaded once per role and cached for the request.
 */
class Rbac
{
    /** Valid action columns on security_role_permission. */
    public const ACTIONS = ['look', 'creat', 'updat', 'del'];

    public static function allows(?User $user, string $object, string $action): bool
    {
        if (! $user || ! in_array($action, self::ACTIONS, true) || ! $user->security_role_id) {
            return false;
        }

        // Permissions are memoized on the User instance (per request, Octane-safe).
        $perms = $user->securityPermissions();

        // Unconfigured role => full access (no lockout of the existing admin).
        if (empty($perms)) {
            return true;
        }

        // Configured role => fail-safe: the object flag must be explicitly "on".
        $row = $perms[mb_strtolower($object)] ?? null;

        return $row !== null && ($row->{$action} ?? null) === 'on';
    }

    /** Throw 403 when the user is not allowed. */
    public static function authorize(?User $user, string $object, string $action): void
    {
        abort_unless(self::allows($user, $object, $action), 403, "Vous n'avez pas le droit de faire cette action.");
    }
}
