<?php

namespace App\Http\Controllers;

use App\Services\AiAssistantService;
use Illuminate\Http\Request;

class AiAssistantController extends Controller
{
    public function form()
    {
        return view('assistant.form', ['title' => 'Assistant Relief Services']);
    }

    public function ask(Request $request, AiAssistantService $assistant)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:120',
            'phone' => 'nullable|string|max:32',
            'email' => 'nullable|email|max:150',
            'question' => 'required|string|max:1000',
        ]);

        $record = $assistant->ask($data['question'], $data);

        return view('assistant.form', [
            'title' => 'Assistant Relief Services',
            'question' => $record->question,
            'answer' => $record->answer,
        ]);
    }

    /**
     * JSON endpoint for the floating chat widget. Reuses the same guarded
     * service (medical guard + fallback live in AiAssistantService::ask), so
     * the widget cannot bypass those safeguards. Throttled at the route level.
     */
    public function chat(Request $request, AiAssistantService $assistant)
    {
        // The floating widget only ever sends a question — do not accept/persist
        // visitor PII (name/phone/email) from this anonymous endpoint.
        $data = $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        $record = $assistant->ask($data['question']);

        return response()->json([
            'question' => $record->question,
            'answer' => $record->answer,
            'status' => $record->status,
        ]);
    }
}
