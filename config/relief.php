<?php

return [
    'name' => 'Relief Services',
    'description' => "Plateforme d'assistance médicale, de gestion de dossiers patients, de devis et de suivi.",
    'contact_phone' => env('RELIEF_CONTACT_PHONE', '+241 76 55 57 81'),
    'contact_email' => env('RELIEF_CONTACT_EMAIL', 'info@reliefservices.net'),

    // Bureaux (utilisés dans l'en-tête, le pied de page et la page contact).
    'offices' => [
        ['city' => 'Libreville', 'country' => 'Gabon', 'phones' => ['+241 76 55 57 81', '+241 66 20 75 25']],
        ['city' => 'Port-Gentil', 'country' => 'Gabon', 'phones' => []],
        ['city' => 'Brazzaville', 'country' => 'Congo', 'phones' => ['+242 666 644 034']],
        ['city' => 'Pointe-Noire', 'country' => 'Congo', 'phones' => ['+242 666 644 034']],
        ['city' => 'Paris', 'country' => 'France', 'phones' => ['+33 7 80 76 31 38']],
    ],
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

    'simulator' => [
        // Frozen on each saved simulation. Bump when the tariff grid changes.
        'tariff_version' => env('SIMULATOR_TARIFF_VERSION', 'v1'),
        'currency' => env('SIMULATOR_CURRENCY', 'XAF'),
        'validity_days' => (int) env('SIMULATOR_VALIDITY_DAYS', 30),
    ],

    // Click-to-chat WhatsApp handoff (a wa.me link — no API needed).
    // The number falls back to contact_phone when WHATSAPP_NUMBER is unset.
    // The prefilled message must never contain medical/personal data.
    'whatsapp' => [
        'enabled' => (bool) env('WHATSAPP_LINK_ENABLED', true),
        'number' => env('WHATSAPP_NUMBER'),
        'message' => env(
            'WHATSAPP_DEFAULT_MESSAGE',
            "Bonjour Relief Services, j'ai besoin d'assistance concernant ma prise en charge.",
        ),
    ],
];
