<?php

namespace Vestis\Exception;

/**
 * Exception für Authentifizierungszwecke
 */
class AuthException extends \Exception
{
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
