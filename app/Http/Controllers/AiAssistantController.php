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
}
