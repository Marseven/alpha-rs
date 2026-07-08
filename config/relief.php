<?php

return [
    'name' => 'Relief Services',
    'description' => "Plateforme d'assistance médicale, de gestion de dossiers patients, de devis et de suivi.",
    'contact_phone' => env('RELIEF_CONTACT_PHONE', ''),
    'contact_email' => env('RELIEF_CONTACT_EMAIL', ''),
    'medical_disclaimer' => "L'assistant IA ne remplace pas un avis médical.",

    // Prefix used to build human-readable case tracking numbers (e.g. RS-AB12CD).
    'tracking_prefix' => env('CASE_TRACKING_PREFIX', 'RS'),

    // SEO defaults (overridable per page via @section('meta_description') etc.).
    'seo' => [
        'description' => "Relief Services organise votre évacuation sanitaire et votre prise en charge médicale à l'étranger depuis le Gabon : devis gratuit, constitution du dossier, rendez-vous médicaux, logement et transport — du premier contact jusqu'au retour.",
        'keywords' => "évacuation sanitaire, assistance médicale, soins à l'étranger, prise en charge CNAMGS, tourisme médical, devis médical, dossier médical, Gabon, Libreville, Port-Gentil",
        'og_image' => 'images/LogoRSA.png',
        'locale' => 'fr_FR',
    ],

    'ai' => [
        'enabled' => (bool) env('AI_ASSISTANT_ENABLED', false),
        'provider' => env('AI_PROVIDER', 'openai'),
        // Any OpenAI-compatible endpoint works (OpenAI, Groq, OpenRouter, Gemini…).
        'base_url' => env('AI_BASE_URL', 'https://api.openai.com/v1'),
        'api_key' => env('AI_API_KEY'),
        'model' => env('AI_MODEL', 'gpt-4o-mini'),
    ],
];
