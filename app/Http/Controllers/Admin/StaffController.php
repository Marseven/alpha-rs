<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Admin management of the medical staff — users with a workflow role
 * (doctor | cnamgs). These accounts sign in to their own dedicated space.
 * Gated by the 'admin' middleware on the route group.
 */
class StaffController extends Controller
{
    private const ROLES = ['doctor', 'cnamgs'];

    public function index()
    {
        $staff = User::whereIn('workflow_role', self::ROLES)->orderBy('name')->get();

        return view('admin.staff.index', ['staff' => $staff]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:32',
            'workflow_role' => 'required|in:doctor,cnamgs',
            'password' => 'required|string|min:8',
            'specialty' => 'nullable|string|max:120',
            'institution' => 'nullable|string|max:180',
            'license_number' => 'nullable|string|max:60',
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? null;
        $user->workflow_role = $data['workflow_role'];
        $user->specialty = $data['specialty'] ?? null;
        $user->institution = $data['institution'] ?? null;
        $user->license_number = $data['license_number'] ?? null;
        $user->password = Hash::make($data['password']);
        $user->email_verified_at = now();
        $user->save();

        return back()->with('success', "Compte {$data['workflow_role']} créé pour {$user->name}.");
    }

    public function update(Request $request, User $user)
    {
        // Only staff accounts are managed here.
        abort_unless(in_array($user->workflow_role, self::ROLES, true), 404);

        if ($request->has('delete')) {
            $user->delete();

            return back()->with('success', 'Compte supprimé.');
        }

        // Suspension: reversible alternative to deletion. The account keeps its
        // history and stays attached to the cases it handled, but can no longer
        // sign in or reach the medical space.
        if ($request->has('suspend')) {
            $user->suspended_at = now();
            $user->save();

            return back()->with('success', "Accès suspendu pour {$user->name}.");
        }

        if ($request->has('reactivate')) {
            $user->suspended_at = null;
            $user->save();

            return back()->with('success', "Accès rétabli pour {$user->name}.");
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:32',
            'workflow_role' => 'required|in:doctor,cnamgs',
            'password' => 'nullable|string|min:8',
            'specialty' => 'nullable|string|max:120',
            'institution' => 'nullable|string|max:180',
            'license_number' => 'nullable|string|max:60',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? null;
        $user->workflow_role = $data['workflow_role'];
        $user->specialty = $data['specialty'] ?? null;
        $user->institution = $data['institution'] ?? null;
        $user->license_number = $data['license_number'] ?? null;
        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return back()->with('success', 'Compte mis à jour.');
    }
}
