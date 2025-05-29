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
        $errorMessage = null;
        /** @phpstan-ignore-next-line secure */
        $productTypeId = intval($_GET['id']);
        $productType = ProductTypeRepository::findById($productTypeId);
        $optionalCategories = CategoryRepository::findAllWithParent();
        $optionalSizes = SizeRepository::findAll();
        $optionalColors = ColorRepository::findAll();

        if ($productType === null) {
            $errorMessage = 'Produkt nicht gefunden!';
            require_once __DIR__.'/../../views/admin/productTypes/edit.php';
            return;
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

                /** @phpstan-ignore-next-line */
                if (CategoryRepository::findById($formData['categoryId']) === null) {
                    throw new ValidationException("Kategorie nicht gefunden!");
                }
                /** @var int  $size */
                /** @phpstan-ignore-next-line */
                foreach ($formData['sizes'] as $size) {
                    if (SizeRepository::findById($size) === null) {
                        throw new ValidationException("Größe nicht gefunden!");
                    }
                }

                /** @var int  $color */
                /** @phpstan-ignore-next-line */
                foreach ($formData['colors'] as $color) {
                    if (ColorRepository::findById($color) === null) {
                        throw new ValidationException("Farbe nicht gefunden!");
                    }
                }

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->name = $formData['name'];

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->categoryId = $formData['categoryId'];

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->material = $formData['material'];

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->price = $formData['price'];

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->description = $formData['description'];

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->collection = $formData['collection'];

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->careInstructions = $formData['careInstructions'];

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->origin = $formData['origin'];

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType->extraFields = $formData['extraFields'];

                ProductTypeRepository::update($productType);

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                ProductTypeRepository::updateSizeMapping($productType->id, $formData['sizes']);

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                ProductTypeRepository::updateColorMapping($productType->id, $formData['colors']);


            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/edit.php';
    }

    public function create(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $optionalCategories = CategoryRepository::findAllWithParent();
        $optionalSizes = SizeRepository::findAll();
        $optionalColors = ColorRepository::findAll();

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
                'extraFields' => new ValidationRule(ValidationType::Json, true),
                'sizes' => new ValidationRule(ValidationType::IntegerArray),
                'colors' => new ValidationRule(ValidationType::IntegerArray),
            ];

            try {
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                if (CategoryRepository::findById($formData['categoryId']) === null) {
                    throw new ValidationException("Kategorie nicht gefunden!");
                }

                /** @var int $size */
                /** @phpstan-ignore-next-line Wurde bereits validiert */
                foreach ($formData['sizes'] as $size) {
                    if (SizeRepository::findById($size) === null) {
                        throw new ValidationException("Größe nicht gefunden!");
                    }
                }

                /** @var int $color */
                /** @phpstan-ignore-next-line Wurde bereits validiert */
                foreach ($formData['colors'] as $color) {
                    if (ColorRepository::findById($color) === null) {
                        throw new ValidationException("Farbe nicht gefunden!");
                    }
                }

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                $productType = ProductTypeRepository::create($formData);

                /** @phpstan-ignore-next-line Wurde bereits validiert */
                ProductTypeRepository::updateSizeMapping($productType->id, $formData['sizes']);
                /** @phpstan-ignore-next-line Wurde bereits validiert */
                ProductTypeRepository::updateColorMapping($productType->id, $formData['colors']);

                header('Location: /admin/productTypes');
                return;

            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/create.php';
    }

    public function assignImages(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        /** @phpstan-ignore-next-line secure */
        $productTypeId = intval($_GET['id']);
        $productType = ProductTypeRepository::findById($productTypeId);
        $page = PaginationUtility::getCurrentPage();
        $assignedImageIds = [];

        if ($productType === null) {
            $errorMessage = 'Produkt nicht gefunden!';
            require_once __DIR__.'/../../views/admin/productTypes/assignImages.php';
            return;
        }

        $persistentAssignedImageIds = $productType->getImageIds();

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
                    if (!is_array($formData['assigned'])) {
                        throw new ValidationException("The assigned images must be an array!");
                    }
                    /** @var array<int, int> $newAssignedImageIds */
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
                    if (isset($formData['assigned']) && is_array($formData['assigned'])) {
                        $newPreSelectedSelection = array_merge($formData['assigned'], $this->getPreSelectedImageIds());
                        $uniqueSelection = array_unique($newPreSelectedSelection);
                        $_GET['preSelected'] = implode(',', $uniqueSelection);
                    }

                    /** @phpstan-ignore-next-line Wurde bereits validiert */
                    header('Location: /admin/productTypes/assignImages?'. PaginationUtility::generateSearchLink($formData['pagination']));
                    return;
                }
            } catch (ValidationException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require_once __DIR__.'/../../views/admin/productTypes/assignImages.php';
    }

    /**
     * @return array<int, int>
     */
    private function getPreSelectedImageIds(): array
    {
        $preSelectedImageIds = [];
        if (isset($_GET['preSelected']) && is_string($_GET['preSelected'])) {
            $idsAsString = explode(',', $_GET['preSelected']);
            $convertedToInt = array_map(fn (string $id) => intval($id), $idsAsString);
            $preSelectedImageIds = array_filter($convertedToInt, fn (int $i) => $i !== 0);
        }
        return $preSelectedImageIds;
    }

}
