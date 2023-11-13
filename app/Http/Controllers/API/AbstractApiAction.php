<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Throwable;

abstract class AbstractApiAction extends Controller
{
    protected const GENERIC_ERROR = 'Oops, something went wrong, please try again later';
    protected function errorResponse(string $message, int $code):JsonResponse
    {
        return response()->json(['error' => $message], $code);
    }
}
