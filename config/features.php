<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Feature Flags
    |--------------------------------------------------------------------------
    |
    | This configuration file manages application-level feature flags that
    | control runtime behavior and UI visibility.
    |
    */

    'registration' => [
        'enabled' => env('REGISTRATION_ENABLED', true),
    ],

    'two_factor_authentication' => [
        'enabled' => env('TWO_FACTOR_AUTHENTICATION_ENABLED', true),
    ],

    'password_visibility_toggle' => [
        'enabled' => env('PASSWORD_VISIBILITY_TOGGLE_ENABLED', true),
    ],

    'flash_toast' => [
        'enabled' => env('FLASH_TOAST_ENABLED', true),
    ],

    'appearance' => [
        'enabled' => env('APPEARANCE_ENABLED', true),
    ],

    'account_deletion' => [
        'enabled' => env('ACCOUNT_DELETION_ENABLED', true),
    ],

    // Future feature flags can be added here
    // Example:
    // 'api_v2' => [
    //     'enabled' => env('API_V2_ENABLED', false),
    // ],
];
