<?php

namespace Vestis\Exception;

use Throwable;

/**
 * Exception that is thrown if any type of validation error occurs.
 */
class ValidationException extends \Exception
{

    public function __construct($message = "", $code = 0, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}