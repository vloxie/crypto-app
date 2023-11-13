<?php

namespace App\Http\Controllers\API;

use App\Services\CryptoInfo\Exceptions\ForbiddenException;
use App\Services\CryptoInfo\Exceptions\GenericException;
use App\Services\CryptoInfo\Exceptions\NotFoundException;
use App\Services\CryptoInfo\Facades\Crypto;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class FindCrypto extends AbstractApiAction
{
    public function __invoke(string $crypto):JsonResponse
    {
        try
        {
            return response()->json(Crypto::find($crypto));
        } catch (NotFoundException|ForbiddenException|GenericException $exception)
        {
            return $this->errorResponse($exception->getMessage(), $exception->getCode());
        } catch (Throwable $exception)
        {
            return $this->errorResponse(self::GENERIC_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
