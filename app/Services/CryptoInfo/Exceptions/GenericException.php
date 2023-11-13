<?php

namespace App\Services\CryptoInfo\Exceptions;

use Exception;

class GenericException extends Exception
{
    public function __construct(string $message = 'Oops, something when wrong', int $code = 500) {
        parent::__construct($message, $code);
    }
}
