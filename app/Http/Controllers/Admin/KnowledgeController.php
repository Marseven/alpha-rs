<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiKnowledgeEntry;
use Illuminate\Http\Request;

/**
 * Admin CRUD for the AI assistant knowledge base (FAQ). Entries feed the
 * chatbot: an instant answer when keywords match, or context for the AI.
 * Gated by the 'admin' middleware on the route group.
 */
class KnowledgeController extends Controller
{
    public function index()
    {
        $entries = AiKnowledgeEntry::latest()->get();

        return view('admin.assistant.knowledge', ['entries' => $entries]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:5000',
            'keywords' => 'nullable|string|max:255',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);

        AiKnowledgeEntry::create($data);

        return back()->with('success', 'Entrée ajoutée à la base de connaissances.');
    }

    public function update(Request $request, AiKnowledgeEntry $entry)
    {
        if ($request->has('delete')) {
            $entry->delete();

            return back()->with('success', 'Entrée supprimée.');
        }

        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:5000',
            'keywords' => 'nullable|string|max:255',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $entry->update($data);

        return back()->with('success', 'Entrée mise à jour.');
    }
}
