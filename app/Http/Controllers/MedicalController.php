<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Shared profile for the medical staff spaces (doctor + cnamgs).
 */
class MedicalController extends Controller
{
    private function guard(): void
    {
        abort_unless(in_array(auth()->user()->workflow_role, ['doctor', 'cnamgs'], true), 403);
    }

    public function profile()
    {
        $this->guard();

        return view('medical.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $this->guard();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:32',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->name = $data['name'];
        $user->phone = $data['phone'] ?? null;
        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return back()->with('success', 'Votre profil a été mis à jour.');
    }
}
