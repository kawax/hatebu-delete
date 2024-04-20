<?php

use function Revolution\Illuminate\Support\env;

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'hatena' => [
        'client_id' => env('HATENA_CLIENT'),
        'client_secret' => env('HATENA_CLIENT_SECRET'),
        'redirect' => env('HATENA_REDIRECT'),
        'scope' => [
            'read_public',
            'write_public',
            'read_private',
            'write_private',
        ],
    ],
];
