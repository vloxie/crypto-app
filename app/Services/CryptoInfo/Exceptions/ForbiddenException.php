<?php

namespace App\Services\CryptoInfo\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    public function __construct(string $message = 'Access has been forbidden', int $code = 403) {
        parent::__construct($message, $code);
    }
}
