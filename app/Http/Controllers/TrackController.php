<?php

namespace App\Http\Controllers;

use App\Models\MedicalCaseWorkflow;
use Illuminate\Http\Request;

/**
 * Public case tracking — patients look up a case with tracking number + phone.
 * Only patient-safe fields are exposed (no documents, no internal notes).
 */
class TrackController extends Controller
{
    public function form()
    {
        return view('track.form', ['title' => 'Suivre mon dossier']);
    }

    public function track(Request $request)
    {
        $data = $request->validate([
            'tracking_number' => 'required|string|max:64',
            'phone' => 'required|string|max:32',
        ]);

        // Both must match — a wrong phone reveals nothing.
        $case = MedicalCaseWorkflow::where('tracking_number', trim($data['tracking_number']))
            ->where('patient_phone', trim($data['phone']))
            ->first();

        if (! $case) {
            return back()
                ->withInput($request->only('tracking_number'))
                ->with('error', "Aucun dossier ne correspond à ce numéro de suivi et ce téléphone.");
        }

        // Patient-safe view model only.
        $result = [
            'tracking_number' => $case->tracking_number,
            'patient_name' => $this->maskName($case->patient_name),
            'status_label' => MedicalCaseWorkflow::patientLabel($case->status),
            'updated_at' => $case->updated_at,
        ];

        return view('track.form', [
            'title' => 'Suivre mon dossier',
            'result' => $result,
        ]);
    }

    /** "Jean Dupont" -> "Jean D." */
    private function maskName(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name));
        if (count($parts) < 2) {
            return $name;
        }
        $last = end($parts);

        return $parts[0] . ' ' . mb_strtoupper(mb_substr($last, 0, 1)) . '.';
    }
}
