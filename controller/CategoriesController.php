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

        $categoryId = intval($_GET["categoryId"]);
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

        $products = ProductTypeRepository::findByCategory($category);

        require_once __DIR__.'/../views/categories/categoryList.php';
    }

    public function clothes(): void
    {
        require_once __DIR__.'/../views/categories/clothes.php';
    }

    public function accesories(): void
    {
        require_once __DIR__ . '/../views/categories/accessories.php';
    }

}
