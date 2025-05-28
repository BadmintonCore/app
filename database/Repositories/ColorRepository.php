<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;
use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;

class ColorRepository
{
    /**
     * @param ProductType $productType
     * @return array<int, Color>
     */
    public static function findByProductType(ProductType $productType): array
    {
        return QueryAbstraction::fetchManyAs(Color::class, "SELECT c.* FROM color c JOIN allowedColor ac ON ac.colorId = c.id WHERE ac.productTypeId = :productId", ["productId" => $productType->id]);
    }

    /**
     * @param Category $category
     * @return array<int, Color>
     */
    public static function findByCategory(Category $category): array
    {
        return QueryAbstraction::fetchManyAs(Color::class, "SELECT DISTINCT c.* FROM color c JOIN allowedColor ac ON ac.colorId = c.id JOIN productType pt ON pt.id = ac.productTypeId WHERE pt.categoryId = :catId", ["catId" => $category->id]);
    }

}
