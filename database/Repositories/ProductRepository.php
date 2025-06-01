<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Product;

/**
 * Repository für @see Product
 */
class ProductRepository
{
    /**
     * Prüft, ob für einen Produkttyp ein Produkt existiert
     *
     * @param int $productTypeId Die ID des Produkttyps
     * @return bool
     */
    public static function isUsed(int $productTypeId): bool
    {
        return QueryAbstraction::fetchOneAs(Product::class, "SELECT productTypeId FROM product WHERE productTypeId = :productTypeId ", ["productTypeId" => $productTypeId]) !== null;
    }
}
