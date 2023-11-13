<?php

return [
    'driver' => env('CRYPTO_INFO_DRIVER', 'coin-gecko'),

    'cache' => [
        'enabled' => env('CRYPTO_INFO_CACHE_ENABLED', true),
        'seconds' => env('CRYPTO_INFO_CACHE_ENABLED', 3600)
    ],



    'coin-gecko' => [
        'base_url' => env('COIN_GECKO_BASE', 'https://api.coingecko.com'),
        'auth_header' => env('COIN_GECKO_AUTH_HEADER', 'x_cg_demo_api_key'),
        'api_key' => env('COIN_GECKO_API_KEY'),
    ]
];
