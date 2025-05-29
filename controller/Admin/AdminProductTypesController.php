<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

class AdminProductTypesController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $page = PaginationUtility::getCurrentPage();

        $productTypes = ProductTypeRepository::findPaginated($page);
        require_once __DIR__.'/../../views/admin/productTypes/list.php';
    }

    public function edit(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $productTypeId = intval($_GET['id']);
        $productType = ProductTypeRepository::findById($productTypeId);
        $optionalCategories = CategoryRepository::findAllWithParent();

        if ($productType === null) {
            $errorMessage = 'Farbe nicht gefunden!';
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String),
                'categoryId' => new ValidationRule(ValidationType::Integer),
                'material' => new ValidationRule(ValidationType::String),
                'price' => new ValidationRule(ValidationType::Float),
                'description' => new ValidationRule(ValidationType::String),
                'collection' => new ValidationRule(ValidationType::String),
                'careInstructions' => new ValidationRule(ValidationType::String),
                'origin' => new ValidationRule(ValidationType::String),
                'extraFields' => new ValidationRule(ValidationType::Json),
            ];

            try {
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                if (CategoryRepository::findById($formData['categoryId']) === null) {
                    throw new ValidationException("Kategorie nicht gefunden!");
                }
                $productType->name = $formData['name'];
                $productType->categoryId = $formData['categoryId'];
                $productType->material = $formData['material'];
                $productType->price = $formData['price'];
                $productType->description = $formData['description'];
                $productType->collection = $formData['collection'];
                $productType->careInstructions = $formData['careInstructions'];
                $productType->origin = $formData['origin'];
                $productType->extraFields = $formData['extraFields'];
                ProductTypeRepository::update($productType);


            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/edit.php';
    }

}