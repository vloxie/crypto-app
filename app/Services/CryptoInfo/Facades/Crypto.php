<?php

namespace App\Services\CryptoInfo\Facades;

use App\Services\CryptoInfo\CryptoInfo;
use App\Services\CryptoInfo\CryptoInfoCache;
use App\Services\CryptoInfo\CryptoList;
use App\Services\CryptoInfo\Enitites\CryptoItem;
use Illuminate\Support\Facades\Facade;


/**
 * @method static CryptoList list(string $currency = 'gbp', int $page = 1, int $perPage = 100)
 * @method static CryptoItem find(string $id)
 */
class Crypto extends Facade
{
    protected static function getFacadeAccessor()
    {
        return config('crypto-info.cache.enabled') ? CryptoInfo::class : CryptoInfo::class;
    }
}
