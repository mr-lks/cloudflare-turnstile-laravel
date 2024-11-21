<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cloudflare Turnstile Keys
    |--------------------------------------------------------------------------
    */
    'site_key' => env('TURNSTILE_SITE_KEY', ''),
    'secret_key' => env('TURNSTILE_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Cloudflare Turnstile API URL
    |--------------------------------------------------------------------------
    */
    'verify_url' => env('TURNSTILE_VERIFY_URL', 'https://challenges.cloudflare.com/turnstile/v0/siteverify'),

    /*
    |--------------------------------------------------------------------------
    | Widget Settings
    |--------------------------------------------------------------------------
    */
    'theme' => 'light', // light, dark, auto
    'size' => 'normal', // normal, compact
];