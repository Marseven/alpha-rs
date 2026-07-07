<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\CaseNotification;
use App\Models\MedicalCaseWorkflow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CaseController extends Controller
{
    /** Cases assigned to the authenticated doctor. */
    public function index()
    {
        $cases = MedicalCaseWorkflow::where('doctor_id', auth()->id())
            ->with('cnamgs')
            ->latest()
            ->paginate(20);

        return view('doctor.cases.index', ['cases' => $cases, 'title' => 'Mes dossiers']);
    }

    /** Form to register a new case. */
    public function create()
    {
        $this->authorize('create', MedicalCaseWorkflow::class);

        return view('doctor.cases.form', ['case' => new MedicalCaseWorkflow(), 'title' => 'Nouveau dossier']);
    }

    /** Persist a new draft case for the authenticated doctor. */
    public function store(Request $request)
    {
        $this->authorize('create', MedicalCaseWorkflow::class);

        $data = $request->validate([
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:32',
            'doctor_note' => 'nullable|string|max:2000',
        ]);

        $case = MedicalCaseWorkflow::create($data + [
            'doctor_id' => auth()->id(),
            'status' => MedicalCaseWorkflow::DRAFT,
        ]);

        return redirect()->route('doctor.cases.show', $case)
            ->with('success', "Dossier {$case->tracking_number} créé.");
    }

    /** Form to edit an editable case (draft / missing-information). */
    public function edit(MedicalCaseWorkflow $case)
    {
        $this->authorize('update', $case);

        return view('doctor.cases.form', ['case' => $case, 'title' => "Modifier {$case->tracking_number}"]);
    }

    /** Update an editable case. */
    public function update(Request $request, MedicalCaseWorkflow $case)
    {
        $this->authorize('update', $case);

        $data = $request->validate([
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:32',
            'doctor_note' => 'nullable|string|max:2000',
        ]);

        $case->update($data);

        return redirect()->route('doctor.cases.show', $case)
            ->with('success', "Dossier {$case->tracking_number} mis à jour.");
    }

    /** Delete a draft case (never sent to CNAMGS). */
    public function destroy(MedicalCaseWorkflow $case)
    {
        $this->authorize('delete', $case);
        $ref = $case->tracking_number;
        $case->delete();

        return redirect()->route('doctor.cases')->with('success', "Dossier {$ref} supprimé.");
    }

    public function show(MedicalCaseWorkflow $case)
    {
        $this->authorize('view', $case);
        $case->load(['cnamgs', 'statusHistories.changedBy', 'folder']);
        $cnamgsList = User::where('workflow_role', 'cnamgs')->orderBy('name')->get();

        return view('doctor.cases.show', compact('case', 'cnamgsList') + ['title' => $case->tracking_number]);
    }

    /** Send the case to the CNAMGS. */
    public function sendToCnamgs(Request $request, MedicalCaseWorkflow $case)
    {
        $this->authorize('sendToCnamgs', $case);

        $data = $request->validate([
            'cnamgs_id' => 'required|exists:users,id',
            'doctor_note' => 'nullable|string|max:2000',
        ]);

        $cnamgs = User::where('id', $data['cnamgs_id'])->where('workflow_role', 'cnamgs')->first();
        if (! $cnamgs) {
            return back()->with('error', "La structure sélectionnée n'est pas une CNAMGS valide.");
        }

        $case->cnamgs_id = $cnamgs->id;
        if (! empty($data['doctor_note'])) {
            $case->doctor_note = $data['doctor_note'];
        }
        $case->changeStatus(MedicalCaseWorkflow::SENT_TO_CNAMGS, auth()->id(), 'Dossier envoyé à la CNAMGS.');

        $this->notifyCnamgs($case, $cnamgs);

        return back()->with('success', "Le dossier {$case->tracking_number} a été envoyé à la CNAMGS.");
    }

    private function notifyCnamgs(MedicalCaseWorkflow $case, User $cnamgs): void
    {
        $notification = $case->notifications()->create([
            'channel' => 'email',
            'recipient' => $cnamgs->email,
            'message' => "Nouveau dossier {$case->tracking_number} reçu pour traitement.",
            'status' => CaseNotification::PENDING,
        ]);

        if (! $cnamgs->email) {
            return;
        }

        try {
            Mail::raw($notification->message, function ($m) use ($cnamgs, $case) {
                $m->to($cnamgs->email)->subject("Nouveau dossier CNAMGS — {$case->tracking_number}");
            });
            $notification->update(['status' => CaseNotification::SENT, 'sent_at' => now()]);
        } catch (\Throwable $e) {
            Log::warning('Case notification email failed: ' . $e->getMessage());
            $notification->update(['status' => CaseNotification::FAILED]);
        }
    }
}
