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
        'client_id' => '837424825350-kjlgrfkfukgae8mk6ush4cio676cp8pd.apps.googleusercontent.com',
        'client_secret' => 'JZBDvUNycapGRggE7v1WHpi-',
        'redirect' => 'http://localhost/india-play/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '133895722149612',
        'client_secret' => '8fcef63f3090401a5f5b878172794bc4',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],
];
