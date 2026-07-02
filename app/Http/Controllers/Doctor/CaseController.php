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
            ->with('pharmacy')
            ->latest()
            ->paginate(20);

        return view('doctor.cases.index', ['cases' => $cases, 'title' => 'Mes dossiers']);
    }

    public function show(MedicalCaseWorkflow $case)
    {
        $this->authorize('view', $case);
        $case->load(['pharmacy', 'statusHistories.changedBy', 'folder']);
        $pharmacies = User::where('workflow_role', 'pharmacy')->orderBy('name')->get();

        return view('doctor.cases.show', compact('case', 'pharmacies') + ['title' => $case->tracking_number]);
    }

    /** Send the case to a CNAMGS/pharmacy. */
    public function sendToPharmacy(Request $request, MedicalCaseWorkflow $case)
    {
        $this->authorize('sendToPharmacy', $case);

        $data = $request->validate([
            'pharmacy_id' => 'required|exists:users,id',
            'doctor_note' => 'nullable|string|max:2000',
        ]);

        $pharmacy = User::where('id', $data['pharmacy_id'])->where('workflow_role', 'pharmacy')->first();
        if (! $pharmacy) {
            return back()->with('error', "La structure sélectionnée n'est pas une CNAMGS/pharmacie valide.");
        }

        $case->pharmacy_id = $pharmacy->id;
        if (! empty($data['doctor_note'])) {
            $case->doctor_note = $data['doctor_note'];
        }
        $case->changeStatus(MedicalCaseWorkflow::SENT_TO_PHARMACY, auth()->id(), 'Dossier envoyé à la CNAMGS.');

        $this->notifyPharmacy($case, $pharmacy);

        return back()->with('success', "Le dossier {$case->tracking_number} a été envoyé à la CNAMGS.");
    }

    private function notifyPharmacy(MedicalCaseWorkflow $case, User $pharmacy): void
    {
        $notification = $case->notifications()->create([
            'channel' => 'email',
            'recipient' => $pharmacy->email,
            'message' => "Nouveau dossier {$case->tracking_number} reçu pour traitement.",
            'status' => CaseNotification::PENDING,
        ]);

        if (! $pharmacy->email) {
            return;
        }

        try {
            Mail::raw($notification->message, function ($m) use ($pharmacy, $case) {
                $m->to($pharmacy->email)->subject("Nouveau dossier CNAMGS — {$case->tracking_number}");
            });
            $notification->update(['status' => CaseNotification::SENT, 'sent_at' => now()]);
        } catch (\Throwable $e) {
            Log::warning('Case notification email failed: ' . $e->getMessage());
            $notification->update(['status' => CaseNotification::FAILED]);
        }
    }
}
