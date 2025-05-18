<?php

namespace Vestis\Exception;

use Throwable;

/**
 * Exceptions für den Aktualisierungs-Prozess des Nutzerbereichs
 */
class UpdateException extends \Exception
{
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
