<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ImageRepository;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Exception\DatabaseException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für die Admin-Panel-Ansichten zu den Farben
 */
class AdminColorsController
{
    /**
     * Listet alle Farben auf
     *
     * @return void
     */
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $colors = ColorRepository::findAll();
        $errorMessage = $_GET["errorMessage"];
        require_once __DIR__ . '/../../views/admin/colors/list.php';
    }

    /**
     * Ansicht zum Bearbeiten einer Farbe
     *
     * @return void
     */
    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        // Fehlermeldung, die im View angezeigt wird
        $errorMessage = null;
        /** @phpstan-ignore-next-line secure */
        $colorId = intval($_GET['id']);


        $color = ColorRepository::findById($colorId);

        // Existiert die angefragte Farbe nicht, so wird die Fehlermeldung im View angezeigt
        if ($color === null) {
            $errorMessage = 'Farbe nicht gefunden!';
            require_once __DIR__ . '/../../views/admin/colors/edit.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'hex' => new ValidationRule(ValidationType::String),
            ];
            try {
                ValidationService::validateForm($validationRules);

                ['name' => $name, 'hex' => $hex] = ValidationService::getFormData();

                // Die Hex Farben aus dem Formular sind genau 7 Zeichen lang
                if (strlen($hex) !== 7) {
                    throw new ValidationException("Invalid color");
                }

                $color->hex = substr($hex, 1, strlen($hex));
                $color->name = $name;

                ColorRepository::update($color);
            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__ . '/../../views/admin/colors/edit.php';
    }

    /**
     * Ansicht zum Erstellen einer Farbe
     *
     * @return void
     */
    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'hex' => new ValidationRule(ValidationType::String),
            ];
            try {
                ValidationService::validateForm($validationRules);

                ['name' => $name, 'hex' => $hex] = ValidationService::getFormData();

                // Hex farben sind immer 7 Zeichen lang (mit #)
                if (strlen($hex) !== 7) {
                    throw new ValidationException("Invalid color");
                }

                $hex = substr($hex, 1, strlen($hex));

                ColorRepository::create($name, $hex);

                header('Location: /admin/colors');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
                require_once __DIR__ . '/../../views/admin/categories/create.php';
            }
        }

        require_once __DIR__ . '/../../views/admin/colors/create.php';
    }

    /**
     * Löschen einer Farbe
     *
     * @return void
     */
    public function delete(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer),
        ];

        try {
            ValidationService::validateForm($validationRules, "GET");

            $formData = ValidationService::getFormData();

            $usedColors = ProductRepository::getColors();

            $usedColor = false;

            for ($i = 0; $i < count($usedColors); $i++) {
                if ($usedColors[$i]->colorId === $formData["id"]) {
                    $usedColor = true;
                    break;
                }
            }

            if (!$usedColor) {
                ColorRepository::delete($formData['id']);
            } else {
                $errorMessage = "Es gibt noch Produkte mit dieser Farbe.";
            }

        } catch (ValidationException|DatabaseException $e) {
            $errorMessage = $e->getMessage();
        }

        if (isset($errorMessage)) {
            header('Location: /admin/colors?errorMessage=Fehler: ' . $errorMessage);
        } else {
            header('Location: /admin/colors');
        }
    }

}
