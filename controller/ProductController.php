<?php

namespace Vestis\Controller;

use Vestis\Database\Repositories\ProductTypeRepository;

/**
 * Controller für Produkte
 */
class ProductController
{
    /**
     * Ansicht eines Produktes im Detail
     *
     * @return void
     */
    public function index(): void
    {
        $errorMessage = null;
        $product = null;

        $itemId = intval($_GET["itemId"] ?? null);
        if ($itemId === 0) {
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
