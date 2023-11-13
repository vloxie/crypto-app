<?php

namespace App\Services\CryptoInfo\Enitites;

use Spatie\DataTransferObject\DataTransferObject;

class CryptoListItem extends DataTransferObject
{
    public string $id;

    public string $name;

    public ?string $image;

    public string $symbol;
    public string $current_price;
    public string $market_cap;
    public string $market_cap_change_24h;
    public string $market_cap_change_percentage_24h;

}
