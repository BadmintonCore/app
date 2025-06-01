<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Product;

class ProductRepository
{

    /**
     * Prüft, ob für ein Produkttyp ein Produkt existiert
     *
     * @param int $productTypeId Die ID des Produkttyps
     * @return bool
     */
    public static function isUsed(int $productTypeId): bool
    {
        return QueryAbstraction::fetchOneAs(Product::class, "SELECT productTypeId FROM product WHERE productTypeId = :productTypeId ", ["productTypeId" => $productTypeId]) !== null;
    }
}
