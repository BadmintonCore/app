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
    /** @var array<string, ValidationType>  */
    private static array $paramTypes = [];

    private static string $method = "post";


    /**
     * Validates the current form submission
     *
     * @param array<string, ValidationRule> $params All validation rules
     * @return void
     * @throws ValidationException Thrown if a field is invalid
     */
    public static function validateForm(array $params, string $method = "POST"): void
    {
        self::$method = $method;
        foreach ($params as $name => $value) {
            self::$paramTypes[$name] = $value->type;
            self::validateField($name, $value, $method);
        }
    }

    /**
     * Gets the form data
     *
     * @return array<string, mixed>
     */
    public static function getFormData(): array
    {
        $target = [];
        foreach (self::$paramTypes as $name => $type) {
            $target[$name] = self::$method === "POST" ? ($_POST[$name] ?? null) : ($_GET[$name] ?? null);
            if ($target[$name] !== null && $type === ValidationType::Boolean) {
                $target[$name] = "on" === $target[$name];
            }
        }
        return $target;
    }

    /**
     * @param string $fieldName The name of the field in the request
     * @param ValidationRule $rule The rule that is used for form validation
     * @return void
     * @throws ValidationException Thrown if a field is invalid
     */
    private static function validateField(string $fieldName, ValidationRule $rule, string $method): void
    {
        $fieldValue = $method === "POST" ? $_POST[$fieldName] ?? null : $_GET[$fieldName] ?? null;
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
                if (strlen($fieldValue) > 255) {
                    throw new ValidationException(sprintf("Field %s should not be longer than 255 chars", $fieldName));
                }
                break;
            case ValidationType::Integer:
                if (self::$method === "GET") {
                    if (!is_string($fieldValue) || intval($fieldValue) <= 0) {
                        throw new ValidationException(sprintf("Field %s must be an int.", $fieldName));
                    }
                } else {
                    if (!is_int($fieldValue)) {
                        throw new ValidationException(sprintf("Field %s must be an int.", $fieldName));
                    }
                }
                break;
            case ValidationType::Email:
                if (false === filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
                    throw new ValidationException(sprintf("Field %s must be a valid email address.", $fieldName));
                }
                break;
            case ValidationType::Boolean:
                if (!is_bool($fieldValue) && $fieldValue !== "on") {
                    throw new ValidationException(sprintf("Field %s must be a boolean.", $fieldName));
                }
                break;
            default:
                throw new ValidationException(sprintf("Field %s must have a valid validation rule.", $fieldName));
        }

    }

}
