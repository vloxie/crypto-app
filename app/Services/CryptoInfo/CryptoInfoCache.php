<?php

namespace App\Services\CryptoInfo;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;

/**
 * @method PromiseInterface|Response list(string $currency = 'gbp', int $page = 1, int $perPage = 100)
 * @method PromiseInterface|Response find(string $id)
 */
class CryptoInfoCache extends CryptoInfo
{
    public function __call(string $name, array $arguments): mixed
    {
        return Cache::remember($name . json_encode($arguments), config('crypto-info.cache.second'), function () use ($arguments, $name) {
            return $this->manager->driver()->{$name}(...$arguments);
        });
    }
}
