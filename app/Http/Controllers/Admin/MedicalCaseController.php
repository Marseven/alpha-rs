<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalCaseWorkflow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Back-office assignment of medical cases.
 *
 * The doctor still creates their own cases; this adds the third-party path from
 * the spec: Relief Services can assign/reassign a case to a doctor and set a
 * processing deadline. Gated by the 'admin' route middleware plus fine-grained
 * RBAC (Cases object).
 */
class MedicalCaseController extends Controller
{
    public function index()
    {
        Controller::he_can('Cases', 'look');

        $cases = MedicalCaseWorkflow::with(['doctor', 'cnamgs'])
            ->orderByRaw('due_at is null, due_at asc')
            ->latest('id')
            ->get();

        $doctors = User::where('workflow_role', 'doctor')
            ->whereNull('suspended_at')
            ->orderBy('name')
            ->get();

        return view('admin.cases.index', [
            'cases' => $cases,
            'doctors' => $doctors,
            'title' => 'Dossiers médicaux',
        ]);
    }

    public function assign(Request $request, MedicalCaseWorkflow $case)
    {
        Controller::he_can('Cases', 'updat');

        // A closed case is not reassignable.
        if ($case->isTerminal()) {
            return back()->with('error', "Ce dossier est clôturé ({$case->status}) et ne peut plus être affecté.");
        }

        $data = $request->validate([
            'doctor_id' => ['required', Rule::exists('users', 'id')->where('workflow_role', 'doctor')],
            'due_at' => 'nullable|date|after_or_equal:today',
            // Reason is required when the case already has a (different) doctor.
            'reason' => 'nullable|string|max:500',
        ]);

        $isReassignment = $case->doctor_id && (int) $case->doctor_id !== (int) $data['doctor_id'];
        if ($isReassignment && empty($data['reason'])) {
            return back()
                ->withErrors(['reason' => 'Un motif est obligatoire pour réaffecter un dossier.'])
                ->withInput();
        }

        // Reject a suspended doctor (belt and braces on top of the index filter).
        $doctor = User::where('id', $data['doctor_id'])->where('workflow_role', 'doctor')->first();
        if (! $doctor || $doctor->isSuspended()) {
            return back()->with('error', "Le médecin sélectionné est indisponible.");
        }

        $case->assignTo((int) $data['doctor_id'], auth()->id(), $data['due_at'] ?? null, $data['reason'] ?? null);

        return back()->with('success', "Dossier {$case->tracking_number} affecté à {$doctor->name}.");
    }
}
