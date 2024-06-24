<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Target theme id
    |--------------------------------------------------------------------------
    |
    | Show admin message only for this theme
    |
    */

    'target_theme_id' => env('VERIFY_TARGET_THEME_ID', '22559417'),



    /*
    |--------------------------------------------------------------------------
    | Support URL
    |--------------------------------------------------------------------------
    |
    | Show support URL in response
    |
    */

    'url' => env('VERIFY_URL', 'support url not set'),



    /*
    |--------------------------------------------------------------------------
    | Support email
    |--------------------------------------------------------------------------
    |
    | Show support email in response
    |
    */

    'email' => env('VERIFY_EMAIL', 'support email not set'),



    /*
    |--------------------------------------------------------------------------
    | Envato API endpoint 
    |--------------------------------------------------------------------------
    |
    | Configure the Envato api url
    |
    */

    'envato_api_endpoint' => env('VERIFY_ENVATO_API_ENDPOINT', 'envato api endpoint not set'),



    /*
    |--------------------------------------------------------------------------
    | Envato API token 
    |--------------------------------------------------------------------------
    |
    | Configure the Envato api token
    |
    */

    'envato_api_token' => env('VERIFY_ENVATO_API_TOKEN', 'envato api token not set'),



    /*
    |--------------------------------------------------------------------------
    | Enable cache 
    |--------------------------------------------------------------------------
    |
    | Set TRUE to cache the license check result
    |
    */

    'cache_use' => env('VERIFY_CACHE_USE', 'TRUE'),



    /*
    |--------------------------------------------------------------------------
    | Cache TTL
    |--------------------------------------------------------------------------
    |
    | Time to live cache in minutes
    |
    */

    'cache_ttl' => env('VERIFY_CACHE_TTL', '168'),

];
