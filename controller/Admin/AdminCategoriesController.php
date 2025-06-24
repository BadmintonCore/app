<?php

/*Autor(en): Mathis Burger, Lasse Hoffmann*/

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Exception\LogicException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\DeletionValidationService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für die Kategorien im Admin-Panel
 */
class AdminCategoriesController
{
    /**
     * Listenansicht aller Kategorien
     *
     * @return void
     */
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $categories = CategoryRepository::findAll();
        $errorMessage = $_GET["errorMessage"] ?? null;
        require_once __DIR__ . '/../../views/admin/categories/list.php';
    }

    /**
     * Bearbeiten einer Kategorie
     *
     * @return void
     */
    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $errorMessage = null;

        $categoryId = intval($_GET['id']);

        $category = CategoryRepository::findById($categoryId);

        // Existiert die Kategorie nicht, wird die Fehlermeldung im View angezeigt
        if ($category === null) {
            $errorMessage = 'Kategorie nicht gefunden!';
            require_once __DIR__ . '/../../views/admin/categories/edit.php';
            return;
        }

        // Kategorien, die zur Auswahl als übergeordnete Kategorie stehen
        $optionalParentCategories = CategoryRepository::findAllWithNoParentNotSelf($categoryId);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'parentCategoryId' => new ValidationRule(ValidationType::Integer),
            ];

            try {
                ValidationService::validateForm($validationRules);

                ['name' => $name, 'parentCategoryId' => $parentCategoryId] = ValidationService::getFormData();

                // Setzen des neuen Namen
                $category->name = $name;

                // "Keine" wurde ausgewählt. Hat demnach den Wert -1
                if ($parentCategoryId === -1) {
                    $category->parentCategoryId = null;
                }
                // Überprüft, ob gegebene Kategorie existiert und setzt die ID dieser als neue parentCategoryId
                if ($parentCategoryId !== -1 && CategoryRepository::findById($parentCategoryId) !== null) {
                    $category->parentCategoryId = $parentCategoryId;
                }

                CategoryRepository::update($category);

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__ . '/../../views/admin/categories/edit.php';
    }

    /**
     * Erstellen einer neuen Kategorie
     *
     * @return void
     */
    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        // Kategorien, die zur Auswahl als übergeordnete Kategorie stehen
        $optionalParentCategories = CategoryRepository::findAllWithNoParent();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'parentCategoryId' => new ValidationRule(ValidationType::Integer),
            ];

            try {
                ValidationService::validateForm($validationRules);

                ['name' => $name, 'parentCategoryId' => $parentCategoryId] = ValidationService::getFormData();


                // -1 soll hier an der Stelle null sein
                $parentCategoryId = $parentCategoryId === -1 ? null : $parentCategoryId;

                // Prüfen, ob die angegebene Kategorie existiert
                if ($parentCategoryId !== null && CategoryRepository::findById($parentCategoryId) === null) {
                    throw new ValidationException('Übergeordnete Kategorie nicht gefunden!');
                }

                $category = CategoryRepository::create($name, $parentCategoryId);

                header('Location: /admin/categories');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__ . '/../../views/admin/categories/create.php';
    }

    /**
     * Löschen einer Kategorie
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
        $deletionValidation = DeletionValidationService::validateCategoryDeletion($formData['id']);

        if ($deletionValidation !== null) {
            throw new LogicException($deletionValidation);
        }

        // Löschen des Eintrags aus der Datenbank, wenn deletionValidation null ist.
        CategoryRepository::delete($formData['id']);

        header('Location: /admin/categories');
    }

}
/*Autor(en): Mathis Burger, Lasse Hoffmann*/
