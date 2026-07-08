<?php

namespace App\Http\Controllers\Cnamgs;

use App\Http\Controllers\Controller;
use App\Models\MedicalCaseWorkflow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CaseController extends Controller
{
    /** Cases received by the authenticated CNAMGS. */
    public function index()
    {
        $cases = MedicalCaseWorkflow::where('cnamgs_id', auth()->id())
            ->with('doctor')
            ->latest()
            ->get();

        return view('cnamgs.cases.index', ['cases' => $cases, 'title' => 'Dossiers reçus']);
    }

    public function show(MedicalCaseWorkflow $case)
    {
        $this->authorize('view', $case);
        $case->load(['doctor', 'statusHistories.changedBy', 'folder']);

        return view('cnamgs.cases.show', compact('case') + ['title' => $case->tracking_number]);
    }

    public function updateStatus(Request $request, MedicalCaseWorkflow $case)
    {
        $this->authorize('updateStatus', $case);

        $data = $request->validate([
            'status' => ['required', Rule::in(MedicalCaseWorkflow::CNAMGS_STATUSES)],
            'cnamgs_note' => 'nullable|string|max:2000',
        ]);

        if (! empty($data['cnamgs_note'])) {
            $case->cnamgs_note = $data['cnamgs_note'];
        }
        $case->changeStatus($data['status'], auth()->id(), $data['cnamgs_note'] ?? null);

        return back()->with('success', "Statut du dossier {$case->tracking_number} mis à jour.");
    }
}
