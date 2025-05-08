<?php

namespace Vestis\Service\validation;

/**
 * Defines the structure of a rule that defines how a specific field should be validated
 */
class ValidationRule
{

    public ValidationType $type;

    public bool $nullable;

    public function __construct(ValidationType $type, bool $nullable = false)
    {
        $this->type = $type;
        $this->nullable = $nullable;
    }

}