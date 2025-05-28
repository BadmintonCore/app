<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class AdminCategoriesController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $categories = CategoryRepository::findAll();
        require_once __DIR__.'/../../views/admin/categories/list.php';
    }

    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $categoryId = intval($_GET['id']);
        $category = CategoryRepository::findById($categoryId);
        if ($category === null) {
             $errorMessage = 'Kategorie nicht gefunden!';
        }

        $optionalParentCategories = CategoryRepository::findAllWithNoParentNotSelf($categoryId);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'parentCategoryId' => new ValidationRule(ValidationType::Integer),
            ];
            try {
                ValidationService::validateForm($validationRules);
                /** @var string $name */
                ['name' => $name, 'parentCategoryId' => $parentCategoryId] = ValidationService::getFormData();
                $category->name = $name;

                // "Keine" wurde ausgewählt. Hat demnach den Wert -1
                if ($parentCategoryId === -1) {
                    $category->parentCategoryId = null;
                }
                // Überprüft ob gegebene Kategorie existiert und setzt die ID dieser als neue parentCategoryId
                if ($parentCategoryId !== -1 && CategoryRepository::findById($parentCategoryId) !== null) {
                    $category->parentCategoryId = $parentCategoryId;
                }

                CategoryRepository::update($category);
            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/categories/edit.php';
    }

}