<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Product;
use Vestis\Database\Models\ProductType;

class ProductRepository
{
    /**
     * @return array<int, Product>
     */
    public static function getIds(): array
    {
        return QueryAbstraction::fetchManyAs(Product::class, "SELECT productTypeId FROM product GROUP BY productTypeId");
    }

    /**
     * @return array<int, Product>
     */
    public static function getSizes(): array
    {
        return QueryAbstraction::fetchManyAs(Product::class, "SELECT sizeId FROM product GROUP BY sizeId");
    }

    /**
     * @return array<int, Product>
     */
    public static function getColors(): array
    {
        return QueryAbstraction::fetchManyAs(Product::class, "SELECT colorId FROM product GROUP BY colorId");
    }
}
