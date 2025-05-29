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

            if ($type === ValidationType::ImageFile) {
                $target[$name] = $_FILES[$name] ?? null;
            }

            if ($target[$name] !== null && $type === ValidationType::Boolean) {
                $target[$name] = "on" === $target[$name];
            }
            if ($type === ValidationType::Integer && is_string($target[$name])) {
                $target[$name] = intval($target[$name]);
            }
            if ($type === ValidationType::IntegerArray && is_array($target[$name])) {
                $target[$name] = array_map('intval', $target[$name]);
            }
            if ($type === ValidationType::Float && is_string($target[$name])) {
                $target[$name] = floatval($target[$name]);
            }

            if ($type === ValidationType::Json && is_string($target[$name]) && trim($target[$name]) === '') {
                $target[$name] = '{}';
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

        if ($rule->type === ValidationType::ImageFile) {
            $fieldValue = $_FILES[$fieldName] ?? null;
        }

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
            case ValidationType::Json:
                if (!is_string($fieldValue)) {
                    throw new ValidationException(sprintf("Field %s must be a JSON string.", $fieldName));
                }
                if (trim($fieldValue) === '') {
                    $fieldValue = '{}';
                }
                if (json_decode($fieldValue) === null) {
                    throw new ValidationException(sprintf("Field %s must be a JSON string.", $fieldName));
                }
                break;
            case ValidationType::Integer:
                self::validateInteger($fieldValue, $fieldName);
                break;
            case ValidationType::IntegerArray:
                if (!is_array($fieldValue)) {
                    throw new ValidationException(sprintf("Field %s must be an array.", $fieldName));
                }
                foreach ($fieldValue as $value) {
                    self::validateInteger($value, $fieldName);
                }
                break;
            case ValidationType::Float:
                if (!(is_string($fieldValue) && floatval($fieldValue) !== 0.0) && !is_float($fieldValue)) {
                    throw new ValidationException(sprintf("Field %s must be an float.", $fieldName));
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
            case ValidationType::ImageFile:
                if ($fieldValue['error'] !== UPLOAD_ERR_OK) {
                    throw new ValidationException(sprintf("Field %s must be a valid image file.", $fieldName));
                }
                $imageInfo = getimagesize($fieldValue['tmp_name']);
                if ($imageInfo === false) {
                    throw new ValidationException(sprintf("Field %s must be a valid image file.", $fieldName));
                }
                if (!str_starts_with($imageInfo['mime'], "image/")) {
                    throw new ValidationException(sprintf("Field %s must be a valid image file.", $fieldName));
                }
                break;
            default:
                throw new ValidationException(sprintf("Field %s must have a valid validation rule.", $fieldName));
        }

    }


    /**
     * @throws ValidationException
     */
    private static function validateInteger(mixed $fieldValue, string $fieldName): void
    {
        if (!(is_string($fieldValue) && intval($fieldValue) !== 0) && !is_int($fieldValue)) {
            throw new ValidationException(sprintf("Field %s must be an int.", $fieldName));
        }
    }

}
