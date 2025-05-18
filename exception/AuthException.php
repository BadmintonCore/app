<?php

namespace Vestis\Exception;

/**
 * Exception used for auth purposes
 */
class AuthException extends \Exception
{
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
