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

    'firebase' => [
        'api_key' => 'AIzaSyDMjGboFWnZuPl_9ZWQU1zHhyFQMmr93JY',
        'auth_domain' => 'carehub-notification.firebaseapp.com',
        'project_id' => 'carehub-notification',
        'storage_bucket' => 'carehub-notification.appspot.com',
        'messaging_sender_id' => '558672562731',
        'app_id' => '558672562731:web:b048a73b58bc2de1ecb86e',
        'measurement_id' => 'G-EW55Z51RQ3',
    ],

    // 'facebook' => [
    //     'client_id' => env('Facebook_CLIENT_ID'),
    //     'client_secret' => env('Facebook_CLIENT_SECRET'),
    //     'redirect' => env('Facebook_REDIRECT'),
    //     'proxy' => true,
    //     'profileFields' => ['id', 'email', 'name', 'phone']
    // ],

    'facebook' => [
        'client_id' => '7201276706581273',
        'client_secret' => '37a5266217cb6d2c7d68e089abd5b694',
        'redirect' => 'https://staging-backend.care-hub.net/facebook/callback/',
    ],

    'google' => [
        'client_id' => env('Google_CLIENT_ID'),
        'client_secret' => env('Google_CLIENT_SECRET'),
        'redirect' => env('Google_REDIRECT'),
    ],

];
