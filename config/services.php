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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '2954297904719467',
        'client_secret' => '5b2fc767f3dec616bc9ec54c95d31227',
        'redirect' => env('APP_URL').'auth/facebook/callback', 
    ],
    'google' => [
        'client_id' => '762772242743-l49pndifif3e8dlqbcosvpbfoatab0an.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => env('APP_URL').'auth/google/callback', 
    ],

];
