<?php

namespace App\Widitrade\Shared\Exceptions;

use Exception;
use Throwable;

class AuthenticationFailedException extends Exception
{
    private const MESSAGE = 'You are not allowed here';

    public function __construct($message = self::MESSAGE, $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}



