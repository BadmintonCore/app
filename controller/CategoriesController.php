<?php

namespace Vestis\Controller;

use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ProductTypeRepository;

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

        $products = ProductTypeRepository::findByCategory($category);

        require_once __DIR__.'/../views/categories/categoryList.php';
    }

}
