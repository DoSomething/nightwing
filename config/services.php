<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => Nightwing\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'fastly' => [
        'key'                   => env('FASTLY_KEY'),
        'table_redirects'       => env('FASTLY_TABLE_REDIRECTS'),
        'table_redirect_types'  => env('FASTLY_TABLE_REDIRECT_TYPES'),
        'service_key'           => env('FASTLY_SERVICE_KEY'),
        'domain'                => env('FASTLY_SERVICE_DOMAIN'),
    ],


    'northstar' => [
        'grant' => 'authorization_code',
        'url' => env('NORTHSTAR_URL'),
        'authorization_code' => [
            'client_id' => env('NORTHSTAR_AUTH_ID'),
            'client_secret' => env('NORTHSTAR_AUTH_SECRET'),
            'scope' => ['user', 'role:staff', 'role:admin'],
            'redirect_uri' => '/login',
        ],
    ],
];
