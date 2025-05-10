<?php

namespace Vestis\Controller;

class CategoriesController
{

    public function index(): void
    {
        if (!empty($_GET["categoryId"])) {
            $categoryId = $_GET["categoryId"];
            $filePath = sprintf("../json/%s.json", $categoryId);
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);
                $jsonContent = json_decode($content, true)[$categoryId];
            }
        }
        require_once '../views/categories/categoryList.php';
    }

}