<?php

namespace Vestis\Controller;

class ProductController
{
    public function index(): void
    {
        $categories = ["bag", "cap", "shirt", "sweater"];
        $mergedContent = [];
        foreach ($categories as $category) {
            $filePath = sprintf("../json/%s.json", $category);
            $jsonContent = json_decode(file_get_contents($filePath), true);
            $mergedContent = array_merge($mergedContent, $jsonContent[$category]);
        }

        if (!empty($_GET["itemId"])) {
            $itemId = intval($_GET["itemId"]);
            $product = array_find($mergedContent, fn ($item) => $item["pid"] === $itemId);
        }

        if (!empty($_GET["itemId2"])) {
            $itemId = intval($_GET["itemId2"]);
            $product2 = array_find($mergedContent, fn ($item) => $item["pid"] === $itemId);
        }
        require_once __DIR__.'/../views/product/itemid.php';
    }

}
