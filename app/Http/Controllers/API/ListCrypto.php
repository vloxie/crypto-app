<?php

namespace App\Http\Controllers\API;

use App\Services\CryptoInfo\Exceptions\ForbiddenException;
use App\Services\CryptoInfo\Exceptions\GenericException;
use App\Services\CryptoInfo\Exceptions\NotFoundException;
use App\Services\CryptoInfo\Facades\Crypto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ListCrypto extends AbstractApiAction
{
    const DEFAULT_PER_PAGE = 10;
    const DEFAULT_PAGE = 1;
    const DEFAULT_CURRENCY = 'gbp';


    public function __invoke():JsonResponse
    {
        try
        {
            return response()->json(Crypto::list(
                self::DEFAULT_CURRENCY,
                self::DEFAULT_PAGE,
                self::DEFAULT_PER_PAGE
            )->toArray());
        } catch (NotFoundException|ForbiddenException|GenericException $exception)
        {
            return $this->errorResponse($exception->getMessage(), $exception->getCode());
        } catch (Throwable $exception)
        {
            return $this->errorResponse(self::GENERIC_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
