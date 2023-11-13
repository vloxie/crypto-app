<?php

namespace App\Services\CryptoInfo\Enitites;

use Spatie\DataTransferObject\DataTransferObject;

class CryptoItem extends DataTransferObject
{
    public string $id;

    public string $name;

    public string $symbol;

    public ?string $image;

    public string $description;
    public string $current_price;
    public string $market_cap;
    public string $price_change_percentage_24h;
    public string $price_change_percentage_7d;
    public string $price_change_percentage_60d;
    public string $market_cap_change_percentage_24h;

}
