<?php

namespace Vestis\Exception;

/**
 * This exception is thrown if something is wrong with email transport.
 */
class EmailException extends \Exception
{
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
