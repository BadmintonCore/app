<?php

/*Autor(en): Mathis Burger, Lasse Hoffmann*/

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\SizeRepository;
use Vestis\Exception\LogicException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\DeletionValidationService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für Größen im Admin-Panel
 */
class AdminSizesController
{
    /**
     * Listenansicht für Größen
     *
     * @return void
     */
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $sizes = SizeRepository::findAll();
        $errorMessage = $_GET["errorMessage"] ?? null;
        require_once __DIR__ . '/../../views/admin/sizes/list.php';
    }

    /**
     * Ansicht zum Bearbeiten einer Größe
     *
     * @return void
     */
    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $errorMessage = null;

        $colorId = intval($_GET['id']);
        $size = SizeRepository::findById($colorId);

        if ($size === null) {
            $errorMessage = 'Größe nicht gefunden!';
            require_once __DIR__ . '/../../views/admin/sizes/edit.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'size' => new ValidationRule(ValidationType::String),
            ];
            try {
                ValidationService::validateForm($validationRules);

                ['size' => $name] = ValidationService::getFormData();

                if (strlen($name) > 3) {
                    throw new ValidationException("Die Größe darf nicht länger als 3 Buchstaben sein");
                }

                $size->size = $name;

                SizeRepository::update($size);

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__ . '/../../views/admin/sizes/edit.php';
    }

    /**
     * Ansicht zum Erstellen einer Größe
     *
     * @return void
     */
    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        if ($_SERVER['REQUEST_METHOD'] === "GET") {

            require_once __DIR__ . '/../../views/admin/sizes/create.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === "POST") {

            $validationRules = [
                'size' => new ValidationRule(ValidationType::String),
            ];
            try {
                ValidationService::validateForm($validationRules);

                ['size' => $name] = ValidationService::getFormData();

                if (strlen($name) > 3) {
                    throw new ValidationException("Die Größe darf nicht länger als 3 Buchstaben sein");
                }

                SizeRepository::create($name);
                header('Location: /admin/sizes');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
                require_once __DIR__ . '/../../views/admin/sizes/create.php';
            }
        }
    }

    /**
     * Löschen einer Größe
     *
     * @return void
     * @throws ValidationException|LogicException
     */
    public function delete(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer),
        ];

        ValidationService::validateForm($validationRules, "GET");

        $formData = ValidationService::getFormData();

        // Überprüft, ob das Löschen der Kategorien gemäß der im DeletionValidationService beschriebenen Regeln möglich ist.
        $deletionValidation = DeletionValidationService::validateSizeDeletion($formData['id']);

        if ($deletionValidation !== null) {
            throw new LogicException($deletionValidation);
        }

        // Löschen des Eintrags aus der Datenbank, wenn deletionValidation null ist.
        SizeRepository::delete($formData['id']);

        header('Location: /admin/sizes');
    }
}
/*Autor(en): Mathis Burger, Lasse Hoffmann*/
