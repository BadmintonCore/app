<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;
use Vestis\Database\Models\ProductType;

class ProductTypeRepository
{

    public static function findByCategory(Category $category): array
    {
        return QueryAbstraction::fetchManyAs(ProductType::class, "SELECT * FROM productType WHERE categoryId = :catId", ["catId" => $category->id]);
    }

    public static function findById(int $id): ?ProductType
    {
        return QueryAbstraction::fetchOneAs(ProductType::class, "SELECT * FROM productType WHERE id = :id", ["id" => $id]);
    }

}