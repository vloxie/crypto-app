<?php

namespace App\Services\CryptoInfo;

use App\Services\CryptoInfo\Enitites\CryptoListItem;

class CryptoList
{
    private array $crypto = [];


    public function add(CryptoListItem $cryptoListItem)
    {
        $this->crypto[] = $cryptoListItem;
    }

    public function toArray(): array
    {
        return $this->crypto;
    }
}
