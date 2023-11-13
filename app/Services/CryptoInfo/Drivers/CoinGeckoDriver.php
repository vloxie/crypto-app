<?php

namespace App\Services\CryptoInfo\Drivers;

use App\Services\CryptoInfo\CryptoList;
use App\Services\CryptoInfo\Enitites\CryptoItem;
use App\Services\CryptoInfo\Enitites\CryptoListItem;
use App\Services\CryptoInfo\Exceptions\ForbiddenException;
use App\Services\CryptoInfo\Exceptions\GenericException;
use App\Services\CryptoInfo\Exceptions\NotFoundException;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response as HttpResponse;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CoinGeckoDriver implements Driver
{
    const LIST_PATH = '/api/v3/coins/markets';
    const FIND_PATH = '/api/v3/coins/';
    const ORDER_MARKET_CAP_ACS = 'market_cap_asc';
    const ORDER_MARKET_CAP_DESC = 'market_cap_desc';
    const ORDER_VOLUME_ACS = 'volume_asc';
    const ORDER_VOLUME_DESC = 'volume_desc';
    const ORDER_ID_ACS = 'id_asc';
    const ORDER_ID_DESC = 'id_desc';

    const ALLOWED_ORDER_VALUES = [
        self::ORDER_MARKET_CAP_ACS,
        self::ORDER_MARKET_CAP_DESC,
        self::ORDER_VOLUME_ACS,
        self::ORDER_VOLUME_DESC,
        self::ORDER_ID_ACS,
        self::ORDER_ID_DESC
    ];


    public function __construct(
        private readonly string $baseUrl,
        private readonly string $apiKey,
        private readonly string $authHeader
    )
    {
    }


    public function list(
        string $currency = 'gbp',
        int    $page = 1,
        int    $perPage = 100,
        string $orderBy = 'market_cap_desc'
    ):CryptoList
    {
        $response = $this->authRequest()
            ->withQueryParameters([
                'vs_currency' => $currency,
                'page' => $page,
                'per_page' => $perPage,
                'order' => $orderBy,
            ])
            ->get(rtrim($this->baseUrl, '/') . self::LIST_PATH);

        if ($response->status() === Response::HTTP_OK)
        {
            return $this->createCryptoListFromResponse($response->json());
        }

        $this->handleErrors($response);
    }


    public function find(string $id):CryptoItem
    {
        $respone = $this->authRequest()
            ->get(rtrim($this->baseUrl, '/') . self::FIND_PATH . $id);

        if ($respone->status() === Response::HTTP_OK)
        {
            return $this->newCryptoItem($respone->json());
        }
    }


    private function authRequest():PendingRequest
    {
        return Http::withHeaders([$this->authHeader => $this->apiKey]);
    }


    private function createCryptoListFromResponse(array $data):CryptoList
    {
        $cryptoList = $this->newCryptoList();

        foreach ($data as $result)
        {
            $cryptoList->add($this->newCryptoListItem($result));
        }

        return $cryptoList;
    }


    private function newCryptoList():CryptoList
    {
        return app(CryptoList::class);
    }


    private function newCryptoListItem(array $result):CryptoListItem
    {
        return new CryptoListItem(
            id: $result['id'],
            name: $result['name'],
            image: $result['image'],
            symbol: $result['symbol'],
            current_price: $result['current_price'],
            market_cap: $result['market_cap'],
            market_cap_change_24h: $result['market_cap_change_24h'],
            market_cap_change_percentage_24h: $result['market_cap_change_percentage_24h']
        );
    }


    private function newCryptoItem(array $result):CryptoItem
    {
        return new CryptoItem(
            id: $result['id'],
            name: $result['name'],
            symbol: $result['symbol'],
            image: $result['image']['large'],
            description: $result['description']['en'],
            current_price: $result['market_data']['current_price']['gbp'],
            market_cap: $result['market_data']['market_cap']['gbp'],
            price_change_percentage_7d: $result['market_data']['price_change_percentage_7d'],
            price_change_percentage_24h: $result['market_data']['price_change_percentage_24h'],
            price_change_percentage_60d: $result['market_data']['price_change_percentage_60d'],
            market_cap_change_percentage_24h: $result['market_data']['market_cap_change_percentage_24h']
        );
    }


    private function handleErrors(PromiseInterface|HttpResponse $response)
    {
        if ($response->status() === Response::HTTP_NOT_FOUND)
        {
            throw new NotFoundException();
        }

        if ($response->status() === Response::HTTP_FORBIDDEN)
        {
            throw new ForbiddenException();
        }

        throw new GenericException(code: $response->status());
    }
}
