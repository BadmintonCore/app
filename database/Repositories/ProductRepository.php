<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Product;
use Vestis\Database\Models\ProductType;

class ProductRepository
{
    public static function hasId(int $productTypeId): bool
    {
        return QueryAbstraction::fetchOneAs(Product::class, "SELECT productTypeId FROM product WHERE productTypeId = :productTypeId ", ["productTypeId" => $productTypeId]) !== null;
    }

    public static function hasSize(int $sizeId): bool
    {
        return QueryAbstraction::fetchOneAs(null, "SELECT sizeId FROM allowedSize WHERE sizeId = :sizeId", ["sizeId" => $sizeId]) !== null;
    }

    public static function hasColor(int $colorId):bool
    {
        return QueryAbstraction::fetchOneAs(null, "SELECT colorId FROM allowedColor WHERE colorId = :colorId", ["colorId" => $colorId]) !== null;
    }
}
