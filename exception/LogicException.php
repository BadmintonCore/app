<?php

namespace Vestis\Exception;

/**
 * Exception für den Logikfehler
 */
class LogicException extends \Exception
{
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
