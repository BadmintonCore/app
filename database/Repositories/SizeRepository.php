<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Size;

class SizeRepository
{
    /**
     * @param ProductType $productType
     * @return array<int, Size>
     */
    public static function findByProductType(ProductType $productType): array
    {
        return QueryAbstraction::fetchManyAs(Size::class, "SELECT s.* FROM size s JOIN allowedSize ac ON ac.sizeId = s.id WHERE ac.productTypeId = :productId", ["productId" => $productType->id]);
    }

    /**
     * @param Category $category
     * @return array<int, Size>
     */
    public static function findByCategory(Category $category): array
    {
        return QueryAbstraction::fetchManyAs(Size::class, "SELECT DISTINCT s.* FROM size s JOIN allowedSize ac ON ac.sizeId = s.id JOIN productType pt ON pt.id = ac.productTypeId WHERE pt.categoryId = :catId", ["catId" => $category->id]);
    }

}
