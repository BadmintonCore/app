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

/**
 * Controller für Kategorien
 */
class CategoriesController
{
    /**
     * Ansicht zum Anzeigen aller Produkte einer Kategorie
     *
     * @return void
     */
    public function index(): void
    {
        $products = [];
        $errorMessage = null;
        $category = null;

        $categoryId = intval($_GET["categoryId"]);
        if ($categoryId === 0) {
            $errorMessage = "Invalide Kategorie ID";
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


        // Farben und Größen für Produkte
        $colors = ColorRepository::findByCategory($category);
        $sizes = SizeRepository::findByCategory($category);
        $minMaxPricesResult = ProductTypeRepository::findMinAndMaxPricesByCategory($category);

        // Wenn kein Minimalpreis existert, dann existert auch kein Maximalpreis
        if ($minMaxPricesResult['min'] === null) {
            $errorMessage = "Minimal und Maximal-Preise konnten nicht geladen werden. Möglicherweise existieren keine Produkte zu dieser Kategorie";
            require_once __DIR__.'/../views/categories/categoryList.php';
            return;
        }

        ['min' => $minPrice, 'max' => $maxPrice] = $minMaxPricesResult;

        // Wir validieren colors und sizes explizit nicht, da diese unten abgefragt werden und dort nur integer zurückgegeben werden.
        // Es findet also schon eine Validierung statt
        $validationRules = [
            'price' => new ValidationRule(ValidationType::Integer, true),
            'search' => new ValidationRule(ValidationType::String, true)
        ];
        try {

            ValidationService::validateForm($validationRules, "GET");

            ['price' => $maxAllowedPrice, 'search' => $search] = ValidationService::getFormData();

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
     * Holt die Filter-Farben aus den GET-Parametern
     *
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
     * Holt die Filter-Größen aus den GET-Parametern
     *
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
