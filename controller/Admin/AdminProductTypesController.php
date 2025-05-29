<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ImageRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\SizeRepository;
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
        $optionalSizes = SizeRepository::findAll();
        $optionalColors = ColorRepository::findAll();

        if ($productType === null) {
            $errorMessage = 'Produkt nicht gefunden!';
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
                'sizes' => new ValidationRule(ValidationType::IntegerArray),
                'colors' => new ValidationRule(ValidationType::IntegerArray),
            ];

            try {
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                if (CategoryRepository::findById($formData['categoryId']) === null) {
                    throw new ValidationException("Kategorie nicht gefunden!");
                }
                foreach ($formData['sizes'] as $size) {
                    if (SizeRepository::findById($size) === null) {
                        throw new ValidationException("Größe nicht gefunden!");
                    }
                }
                foreach ($formData['colors'] as $color) {
                    if (ColorRepository::findById($color) === null) {
                        throw new ValidationException("Farbe nicht gefunden!");
                    }
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

                ProductTypeRepository::updateSizeMapping($productType->id, $formData['sizes']);
                ProductTypeRepository::updateColorMapping($productType->id, $formData['colors']);


            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/edit.php';
    }

    public function assignImages(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $productTypeId = intval($_GET['id']);
        $productType = ProductTypeRepository::findById($productTypeId);
        $page = PaginationUtility::getCurrentPage();

        if ($productType === null) {
            $errorMessage = 'Produkt nicht gefunden!';
        }

        $persistentAssignedImageIds = $productType?->getImageIds() ?? [];

        $assignedImageIds = array_merge($persistentAssignedImageIds, $this->getPreSelectedImageIds());
        $images = ImageRepository::findPaginated($page);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            try {
                if (isset($_POST['submitButton'])) {
                    $validationRules = [
                        'assigned' => new ValidationRule(ValidationType::IntegerArray, true),
                    ];
                    ValidationService::validateForm($validationRules);
                    $formData = ValidationService::getFormData();
                    $formData['assigned'] = $formData['assigned'] ?? [];
                    $newAssignedImageIds = array_unique(array_merge($formData['assigned'], $this->getPreSelectedImageIds()));
                    ProductTypeRepository::updateImageMapping($productType->id, $newAssignedImageIds);
                    header('Location: /admin/productTypes');
                    return;
                } else {
                    $validationRules = [
                        'pagination' => new ValidationRule(ValidationType::Integer),
                        'assigned' => new ValidationRule(ValidationType::IntegerArray, true),
                    ];
                    ValidationService::validateForm($validationRules);
                    $formData = ValidationService::getFormData();
                    if (isset($formData['assigned'])) {
                        $newPreSelectedSelection = array_merge($formData['assigned'], $this->getPreSelectedImageIds());
                        $uniqueSelection = array_unique($newPreSelectedSelection);
                        $_GET['preSelected'] = implode(',', $uniqueSelection);
                    }
                    header('Location: /admin/productTypes/assignImages?'. PaginationUtility::generateSearchLink($formData['pagination']));
                    return;
                }
            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/assignImages.php';
    }

    private function getPreSelectedImageIds(): array
    {
        $preSelectedImageIds = [];
        if (isset($_GET['preSelected'])) {
            $idsAsString = explode(',', $_GET['preSelected']);
            $convertedToInt = array_map('intval', $idsAsString);
            $preSelectedImageIds = array_filter($convertedToInt, fn (int $i) => $i !== 0);
        }
        return $preSelectedImageIds;
    }

}