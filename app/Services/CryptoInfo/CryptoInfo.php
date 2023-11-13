<?php

namespace App\Services\CryptoInfo;

use App\Services\CryptoInfo\Enitites\CryptoItem;

/**
 * @method CryptoList list(string $currency = 'gbp', int $page = 1, int $perPage = 100)
 * @method CryptoItem find(string $id)
 */
class CryptoInfo
{
    public function __construct(protected DriverManager $manager)
    {}

    public function __call(string $name, array $arguments): mixed
    {
        return $this->manager->driver()->{$name}(...$arguments);
    }
}
