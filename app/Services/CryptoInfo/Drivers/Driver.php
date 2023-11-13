<?php

namespace App\Services\CryptoInfo\Drivers;

use App\Services\CryptoInfo\CryptoList;
use App\Services\CryptoInfo\Enitites\CryptoItem;

interface Driver
{
    public function list(
        string $currency = 'gbp',
        int $page = 1,
        int $perPage = 100
    ): CryptoList;

    public function find(string $id): CryptoItem;
}
