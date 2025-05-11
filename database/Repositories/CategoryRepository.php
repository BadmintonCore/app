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

    /**
     * Gets a category by ID
     *
     * @param int $id the ID
     * @return Category|null The category
     */
    public static function findById(int $id): ?Category
    {
        return QueryAbstraction::fetchOneAs(Category::class, "SELECT * FROM category WHERE id = :id", ['id' => $id]);
    }

    /**
     * Finds many by parent category id
     *
     * @param int $id The parent category ID
     * @return array<int, Category>
     */
    public static function findByParentId(int $id): array
    {
        return QueryAbstraction::fetchManyAs(Category::class, "SELECT * FROM category WHERE parentCategoryId = :id", ["id" => $id]);
    }

}
