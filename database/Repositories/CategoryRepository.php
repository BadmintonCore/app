<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;

class CategoryRepository
{
    /**
     * Gets all categories that do not have a parent category
     *
     * @return array<int, Category>
     */
    public static function findAllWithNoParent(): array
    {
        return QueryAbstraction::fetchManyAs(Category::class, "SELECT * FROM category WHERE parentCategoryId IS NULL");
    }

}
