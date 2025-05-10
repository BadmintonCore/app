<?php

namespace Vestis\Service;

use Vestis\Exception\ValidationException;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;

/**
 * Implements functionality to validate different things like forms.
 */
class ValidationService
{
    /**
     * Validates the current form submission
     *
     * @param array<string, ValidationRule> $params All validation rules
     * @return void
     * @throws ValidationException Thrown if a field is invalid
     */
    public static function validateForm(array $params): void
    {
        foreach ($params as $name => $value) {
            self::validateField($name, $value);
        }
    }

    /**
     * @param string $fieldName The name of the field in the request
     * @param ValidationRule $rule The rule that is used for form validation
     * @return void
     * @throws ValidationException Thrown if a field is invalid
     */
    private static function validateField(string $fieldName, ValidationRule $rule): void
    {
        $fieldValue = $_POST[$fieldName] ?? null;
        if ($fieldValue === null) {
            if (!$rule->nullable) {
                throw new ValidationException(sprintf("Field %s is required.", $fieldName));
            }
            return;
        }

        switch ($rule->type) {
            case ValidationType::String:
                if (!is_string($fieldValue)) {
                    throw new ValidationException(sprintf("Field %s must be a string.", $fieldName));
                }
                break;
            case ValidationType::Integer:
                if (!is_int($fieldValue)) {
                    throw new ValidationException(sprintf("Field %s must be an int.", $fieldName));
                }
                break;
            case ValidationType::Email:
                if (!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
                    throw new ValidationException(sprintf("Field %s must be a valid email address.", $fieldName));
                }
                break;
            case ValidationType::Boolean:
                if (!is_bool($fieldValue)) {
                    throw new ValidationException(sprintf("Field %s must be a boolean.", $fieldName));
                }
                break;
            default:
                throw new ValidationException(sprintf("Field %s must have a valid validation rule.", $fieldName));
        }

    }

}
