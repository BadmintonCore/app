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
            $content = file_get_contents($filePath);
            if ($content !== false) {
                /** @var array<string, array<int, array<string, int|string>>> $jsonContent */
                $jsonContent = json_decode($content, true);
                $mergedContent = array_merge($mergedContent, $jsonContent[$category]);
            }

        }

        $product = null;
        $product2 = null;

        if (is_string($_GET["itemId"])) {
            $itemId = intval($_GET["itemId"]);
            $product = array_find($mergedContent, fn ($item) => $item["pid"] === $itemId);
        }

        if (is_string($_GET["itemId2"])) {
            $itemId = intval($_GET["itemId2"]);
            $product2 = array_find($mergedContent, fn ($item) => $item["pid"] === $itemId);
        }
        require_once __DIR__.'/../views/product/itemid.php';
    }

}
