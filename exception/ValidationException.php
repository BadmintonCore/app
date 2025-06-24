<?php

//Autor(en): Mathis Burger

namespace Vestis\Exception;

/**
 * Ausnahme, die ausgelöst wird, wenn ein Validierungsfehler auftritt
 */
class ValidationException extends \Exception
{
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
//Autor(en): Mathis Burger
