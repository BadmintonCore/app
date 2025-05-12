<?php

namespace Vestis\Controller;

class CategoriesController
{
    public function index(): void
    {
        $jsonContent = null;
        if ($_GET["categoryId"] !== null && $_GET["categoryId"] !== "") {
            /** @var string $categoryId */
            $categoryId = $_GET["categoryId"];
            $filePath = sprintf("../json/%s.json", $categoryId);
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);
                if ($content !== false) {
                    /** @var array<string, array<int, array<string, int|string>>> $decoded */
                    $decoded = json_decode($content, true);
                    $jsonContent = $decoded[$categoryId];
                }
            }
        }
        require_once __DIR__.'/../views/categories/categoryList.php';
    }

    public function clothes(): void
    {
        require_once __DIR__.'/../views/categories/clothes.php';
    }

    public function accesories(): void
    {
        require_once __DIR__.'/../views/categories/accesories.php';
    }

}
