<?php

namespace Vestis\Exception;

/**
 * Diese Ausnahme wird ausgelöst, wenn etwas mit dem E-Mail-Transport nicht stimmt.
 */
class EmailException extends \Exception
{
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
