<?php

namespace Vestis\Controller;

use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\SizeRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class CategoriesController
{
    public function index(): void
    {
        $products = [];
        $errorMessage = null;
        $category = null;

        if ($_GET["categoryId"] === null || $_GET["categoryId"] === "") {
            $errorMessage = "Invalide Kategorie ID";
            require_once __DIR__.'/../views/categories/categoryList.php';
            return;
        }
        /** @var string|null $categoryIdString */
        $categoryIdString = $_GET["categoryId"];
        $categoryId = intval($categoryIdString);
        if ($categoryId === 0) {
            $errorMessage = "Kategorie nicht gefunden";
            require_once __DIR__.'/../views/categories/categoryList.php';
            return;
        }

        $category = CategoryRepository::findById($categoryId);
        if ($category === null) {
            $errorMessage = "Kategorie nicht gefunden";
            require_once __DIR__.'/../views/categories/categoryList.php';
            return;
        }

        if ($category->getParentCategory() === null) {
            require_once __DIR__.'/../views/categories/childCategories.php';
        }



        $colors = ColorRepository::findByCategory($category);
        $sizes = SizeRepository::findByCategory($category);
        $minMaxPricesResult = ProductTypeRepository::findMinAndMaxPricesByCategory($category);

        if ($minMaxPricesResult === null) {
            $errorMessage = "Minimal und Maximal-Preise konnten nicht geladen werden";
            require_once __DIR__.'/../views/categories/categoryList.php';
            return;
        }

        ['min' => $minPrice, 'max' => $maxPrice] = $minMaxPricesResult;

        // Wir validieren colors und sizes explizit nicht, da diese unten abgefragt werden und dort nur integer zurückgegeben werden.
        // Es findet also schon eine Validierung statt
        $validationRules = [
            'price' => new ValidationRule(ValidationType::Integer, true),
            'search' => new ValidationRule(ValidationType::String, true),
        ];
        try {

            ValidationService::validateForm($validationRules, "GET");
            /** @var int|null $maxAllowedPrice */
            /** @var string|null $search */
            ['price' => $maxAllowedPrice, 'search' => $search] = ValidationService::getFormData();

            /** @var int $maxAllowedPrice */
            $maxAllowedPrice = $maxAllowedPrice ?? $maxPrice;
            $allowedColors = $this->getFilteredColorIds();
            $allowedSizes = $this->getFilteredSizeIds();

            $products = ProductTypeRepository::findByParams($category, $maxAllowedPrice, $allowedColors, $allowedSizes, $search);
        } catch (ValidationException $e) {
            $errorMessage = $e->getMessage();
        }

        require_once __DIR__.'/../views/categories/categoryList.php';
    }


    /**
     * @return array<int, int>
     */
    private function getFilteredColorIds(): array
    {
        $ids = [];
        foreach ($_GET as $key => $value) {
            if (str_starts_with($key, 'color_')) {
                if (is_string($value) && intval($value) > 0) {
                    $ids[] = intval($value);
                }
            }
        }
        return $ids;
    }

    /**
     * @return array<int, int>
     */
    private function getFilteredSizeIds(): array
    {
        $ids = [];
        foreach ($_GET as $key => $value) {
            if (str_starts_with($key, 'size_')) {
                if (is_string($value) && intval($value) > 0) {
                    $ids[] = intval($value);
                }
            }
        }
        return $ids;
    }

}
