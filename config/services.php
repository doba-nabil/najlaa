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

    'google' => [
        'client_id'     => '134240189270-moom87592d0vs9fks6rf9d9o5hafi87p.apps.googleusercontent.com',
        'client_secret' => '2qt6AGRcLo2T7dJ40hUFNKhu',
        'redirect'      => 'https://najlaboutique.qa/auth/google/callback'
    ],

    'facebook' => [
        'client_id'     => '2797712193777321',
        'client_secret' => 'de007e0a49e71f931d28db38d243b024',
        'redirect'      => 'https://najlaboutique.qa/auth/facebook/callback'
    ],
];
