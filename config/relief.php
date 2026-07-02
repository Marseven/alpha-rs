<?php

return [
    'name' => 'Relief Services',
    'description' => "Plateforme d'assistance médicale, de gestion de dossiers patients, de devis et de suivi.",
    'contact_phone' => env('RELIEF_CONTACT_PHONE', ''),
    'contact_email' => env('RELIEF_CONTACT_EMAIL', ''),
    'medical_disclaimer' => "L'assistant IA ne remplace pas un avis médical.",

    // Prefix used to build human-readable case tracking numbers (e.g. RS-AB12CD).
    'tracking_prefix' => env('CASE_TRACKING_PREFIX', 'RS'),

    'ai' => [
        'enabled' => (bool) env('AI_ASSISTANT_ENABLED', false),
        'provider' => env('AI_PROVIDER', 'openai'),
        'api_key' => env('AI_API_KEY'),
        'model' => env('AI_MODEL', 'gpt-4o-mini'),
    ],
];
