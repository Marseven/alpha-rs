<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'singpay' => [
        'base_url' => env('SINGPAY_BASE_URL', 'https://gateway.singpay.ga/v1/ext'),
        'client_id' => env('SINGPAY_CLIENT_ID'),
        'client_secret' => env('SINGPAY_CLIENT_SECRET'),
        'wallet_id' => env('SINGPAY_WALLET_ID'),
        'disbursement_wallet_id' => env('SINGPAY_DISBURSEMENT_WALLET_ID'),
    ],

    'ebilling' => [
        'base_url' => env('EBILLING_BASE_URL', env('SERVER_URL')),
        'post_url' => env('EBILLING_POST_URL', env('POST_URL')),
        'username' => env('EBILLING_USERNAME', env('USER_NAME')),
        'shared_key' => env('EBILLING_SHARED_KEY', env('SHARED_KEY')),
    ],

    // Shared secret used to authenticate incoming payment webhooks (HMAC).
    'payment' => [
        'webhook_secret' => env('PAYMENT_WEBHOOK_SECRET'),
        // Flat fee charged for a quote (devis) request, in FCFA.
        'quote_amount' => (float) env('QUOTE_PAYMENT_AMOUNT', 50000),
    ],

];
