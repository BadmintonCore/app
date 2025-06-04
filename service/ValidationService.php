<?php

namespace Vestis\Service;

use Vestis\Exception\ValidationException;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;

/**
 * Implementiert Funktionalität zur Validierung verschiedener Dinge wie Formulare
 */
class ValidationService
{
    /** @var array<string, ValidationType>  */
    private static array $paramTypes = [];

    private static string $method = "post";


    /**
     * Validiert die aktuelle Formularübermittlung
     *
     * @param array<string, ValidationRule> $params Alle Validierungsregeln
     * @param string $method
     * @return void
     * @throws ValidationException Wird geworfen, wenn ein Feld invalide ist
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
     * Ruft die Formulardaten ab
     *
     * @return array<string, mixed>
     */
    public static function getFormData(): array
    {
        $target = [];
        foreach (self::$paramTypes as $name => $type) {
            $target[$name] = self::$method === "POST" ? ($_POST[$name] ?? null) : ($_GET[$name] ?? null);

            // Setzt den Dateityp aus der Variablen $_FILES
            if ($type === ValidationType::ImageFile) {
                $target[$name] = $_FILES[$name] ?? null;
            }

            // Konvertiert die Zeichenkette „on“ oder null in einen booleschen Wert, wenn der Validierungstyp Boolean ist
            if ($type === ValidationType::Boolean) {
                $target[$name] = match ($target[$name] !== null) {
                    true => "on" === $target[$name],
                    false => false
                };
            }

            // Konvertiert eine mögliche Zeichenkette in eine Ganzzahl, wenn der Validierungstyp Integer ist
            if ($type === ValidationType::Integer && (is_string($target[$name]))) {
                $target[$name] = intval($target[$name]);
            }

            // Konvertiert jeden Wert eines Integer-Arrays in ein aktuelles Integer-Array, wenn der Validierungstyp Integer-Array ist
            if ($type === ValidationType::IntegerArray && is_array($target[$name])) {
                $target[$name] = array_map(fn (mixed $value) => (is_string($value) || is_int($value)) ? intval($value) : 0, $target[$name]);
            }

            // Konvertiert eine Zeichenkette in eine Fließkommazahl, wenn der Validierungstyp Float ist
            if ($type === ValidationType::Float && is_string($target[$name])) {
                $target[$name] = floatval($target[$name]);
            }

            // Legt den Standardwert für ein leeres json fest, wenn der Validierungstyp JSON ist
            if ($type === ValidationType::Json && is_string($target[$name]) && trim($target[$name]) === '') {
                $target[$name] = '{}';
            }
        }
        return $target;
    }

    /**
     * Überprüft ein Feld, ob der enthaltene Wert gültig ist oder nicht
     *
     * @param string $fieldName Der Name des Feldes in der Anfrage
     * @param ValidationRule $rule Die Regel, die für die Formularvalidierung verwendet wird
     * @param string $method Die Methode, die das Formular verwendet
     * @return void
     * @throws ValidationException Wird geworfen, wenn ein Feld invalide ist
     */
    private static function validateField(string $fieldName, ValidationRule $rule, string $method): void
    {
        $fieldValue = $method === "POST" ? $_POST[$fieldName] ?? null : $_GET[$fieldName] ?? null;

        if ($rule->type === ValidationType::ImageFile) {
            $fieldValue = $_FILES[$fieldName] ?? null;
        }

        if ($fieldValue === null) {
            if (!$rule->nullable) {
                throw new ValidationException(sprintf("Das Feld %s ist erforderlich.", $fieldName));
            }
            return;
        }

        switch ($rule->type) {
            case ValidationType::String:
                if (!is_string($fieldValue)) {
                    throw new ValidationException(sprintf("Das Feld %s muss ein String sein.", $fieldName));
                }
                if (strlen($fieldValue) > 255) {
                    throw new ValidationException(sprintf("Das Feld %s sollte nicht länger als 255 Zeichen sein.", $fieldName));
                }
                break;

            case ValidationType::Json:
                if (!is_string($fieldValue)) {
                    throw new ValidationException(sprintf("Der Feld %s muss JSON sein.", $fieldName));
                }
                if (trim($fieldValue) === '') {
                    $fieldValue = '{}';
                }
                if (json_decode($fieldValue) === null) {
                    throw new ValidationException(sprintf("Das Feld %s muss ein String sein.", $fieldName));
                }
                break;

            case ValidationType::Integer:
                self::validateInteger($fieldValue, $fieldName);
                break;

            case ValidationType::IntegerArray:
                if (!is_array($fieldValue)) {
                    throw new ValidationException(sprintf("Das Feld %s muss ein Array sein.", $fieldName));
                }
                foreach ($fieldValue as $value) {
                    self::validateInteger($value, $fieldName);
                }
                break;

            case ValidationType::Float:
                if (!(is_string($fieldValue) && floatval($fieldValue) !== 0.0) && !is_float($fieldValue)) {
                    throw new ValidationException(sprintf("Das Feld %s muss eine float sein.", $fieldName));
                }
                break;

            case ValidationType::Email:
                if (false === filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
                    throw new ValidationException(sprintf("Das Feld %s muss eine E-Mail sein.", $fieldName));
                }
                break;

            case ValidationType::Boolean:
                if (!is_bool($fieldValue) && $fieldValue !== "on") {
                    throw new ValidationException(sprintf("Das Feld %s muss ein boolean sein.", $fieldName));
                }
                break;

            case ValidationType::ImageFile:
                if ($fieldValue['error'] !== UPLOAD_ERR_OK) {
                    throw new ValidationException(sprintf("Das Feld %s muss eine valide Bilddatei sein.", $fieldName));
                }

                if (!is_string($fieldValue['tmp_name'])) {
                    throw new ValidationException("Der Name der Datei muss ein String sein");
                }

                $imageInfo = getimagesize($fieldValue['tmp_name']);
                if ($imageInfo === false) {
                    throw new ValidationException(sprintf("Das Feld %s muss eine valide Bilddatei sein.", $fieldName));
                }
                if (!str_starts_with($imageInfo['mime'], "image/")) {
                    throw new ValidationException(sprintf("Das Feld %s muss eine valide Bilddatei sein.", $fieldName));
                }
                break;

            default:
                throw new ValidationException(sprintf("Das Feld %s muss eine gültige Validierungsregel haben.", $fieldName));
        }

    }


    /**
     * Validiert einen Integer-Wert
     *
     * @throws ValidationException
     */
    public static function validateInteger(mixed $fieldValue, string $fieldName): void
    {
        if (is_string($fieldValue)) {
            if (intval($fieldValue) === 0 && trim($fieldValue) !== "0") {
                throw new ValidationException(sprintf("Das Feld %s muss ein integer sein.", $fieldName));
            }
        } else {
            if (!is_int($fieldValue)) {
                throw new ValidationException(sprintf("Das Feld %s muss ein integer sein.", $fieldName));
            }
        }
    }

}
