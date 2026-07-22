<?php

/**
 * External hotel inventory providers.
 *
 * Business logic never reads these values directly — it depends only on the
 * App\Services\Inventory\Contracts\InventoryProvider interface, and
 * InventoryServiceProvider resolves the concrete driver named by
 * `inventory.default`. To add RateHawk/Hotelbeds/WebBeds later you add a
 * block here + an adapter class; no business code changes.
 *
 * EVERY credential is read from the environment — nothing is hardcoded.
 * Fill the real values in your (git-ignored) .env file, never in source.
 */
return [

    'default' => env('INVENTORY_PROVIDER', 'tbo'),

    'providers' => [

        'tbo' => [
            'driver' => 'tbo',
            'base_url' => env('TBO_BASE_URL'),
            'email' => env('TBO_EMAIL'),
            'username' => env('TBO_USERNAME'),
            'password' => env('TBO_PASSWORD'),
            'agency_id' => env('TBO_AGENCY_ID'),
            'api_key' => env('TBO_API_KEY'),
            'timeout' => (int) env('TBO_TIMEOUT', 30),
        ],

        // Placeholders for future adapters — keys read from env when built.
        // 'ratehawk'  => [ 'driver' => 'ratehawk',  'base_url' => env('RATEHAWK_BASE_URL'),  'key_id' => env('RATEHAWK_KEY_ID'),  'api_key' => env('RATEHAWK_API_KEY') ],
        // 'hotelbeds' => [ 'driver' => 'hotelbeds', 'base_url' => env('HOTELBEDS_BASE_URL'), 'api_key' => env('HOTELBEDS_API_KEY'), 'secret' => env('HOTELBEDS_SECRET') ],
        // 'webbeds'   => [ 'driver' => 'webbeds',   'base_url' => env('WEBBEDS_BASE_URL'),   'username' => env('WEBBEDS_USERNAME'), 'password' => env('WEBBEDS_PASSWORD') ],
    ],
];
