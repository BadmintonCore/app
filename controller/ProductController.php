<?php

namespace Vestis\Controller;

use Vestis\Database\Repositories\ProductTypeRepository;

class ProductController
{
    public function index(): void
    {
        $errorMessage = null;
        $product = null;

        if (!isset($_GET["itemId"]) || !is_string($_GET["itemId"])) {
            $errorMessage = "Invalider Parameter";
            require_once __DIR__.'/../views/product/itemid.php';
            return;
        }

        $itemId = intval($_GET["itemId"]);
        if ($itemId <= 0) {
            $errorMessage = "Invalider Parameter";
            require_once __DIR__.'/../views/product/itemid.php';
            return;
        }

        $product = ProductTypeRepository::findById($itemId);
        if (null === $product) {
            $errorMessage = "Produkt nicht gefunden";
            require_once __DIR__.'/../views/product/itemid.php';
            return;
        }

        require_once __DIR__.'/../views/product/itemid.php';
    }

}
