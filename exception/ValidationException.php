<?php

namespace Vestis\Exception;

/**
 * Exception that is thrown if any type of validation error occurs.
 */
class ValidationException extends \Exception
{
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
