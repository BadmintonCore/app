<?php

namespace Vestis\Controller;

use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Database\Repositories\SizeRepository;

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
        ['min' => $minPrice, 'max' => $maxPrice] = ProductTypeRepository::findMinAndMaxPricesByCategory($category);

        $maxAllowedPrice = $_GET['price'] ?? $maxPrice;
        $allowedColors = $this->getFilteredColorIds();
        $allowedSizes = $this->getFilteredSizeIds();
        $search = $_GET['search'] ?? null;


        $products = ProductTypeRepository::findByParams($category, $maxAllowedPrice, $allowedColors, $allowedSizes, $search);


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
                if (intval($value) >0 ) {
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
                if (intval($value) > 0) {
                    $ids[] = intval($value);
                }
            }
        }
        return $ids;
    }

}
