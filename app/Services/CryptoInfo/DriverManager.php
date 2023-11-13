<?php

namespace App\Services\CryptoInfo;

use App\Services\CryptoInfo\Drivers\CoinGeckoDriver;
use App\Services\CryptoInfo\Drivers\Driver;
use Illuminate\Support\Manager;

class DriverManager extends Manager
{
    public function createCoinGeckoDriver(): Driver
    {
        return new CoinGeckoDriver(
            baseUrl: config('crypto-info.coin-gecko.base_url'),
            apiKey: config('crypto-info.coin-gecko.api_key'),
            authHeader: config('crypto-info.coin-gecko.auth_header')
        );
    }
    public function getDefaultDriver()
    {
        return config('crypto-info.driver');
    }
}
