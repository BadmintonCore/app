<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;

class CategoryRepository
{
    /**
     * @return array<int, Category>
     */
    public static function findAll(): array
    {
        return QueryAbstraction::fetchManyAs(Category::class, "SELECT * FROM category");
    }

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
     * Gets all categories that do have a parent category
     *
     * @return array<int, Category>
     */
    public static function findAllWithParent(): array
    {
        return QueryAbstraction::fetchManyAs(Category::class, "SELECT * FROM category WHERE parentCategoryId IS NOT NULL");
    }

    /**
     * Gets all categories that do not have a parent category and are not the given ID
     *
     * @param int $id
     *
     * @return array<int, Category>
     */
    public static function findAllWithNoParentNotSelf(int $id): array
    {
        return QueryAbstraction::fetchManyAs(Category::class, "SELECT * FROM category WHERE parentCategoryId IS NULL AND id != :id", ["id" => $id]);
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

    public static function create(string $name, ?int $parentCategoryId): ?Category
    {
        return QueryAbstraction::executeReturning(Category::class, "INSERT INTO category (name, parentCategoryId) VALUES (:name, :parentCategoryId)", ["name" => $name, "parentCategoryId" => $parentCategoryId]);
    }

    public static function update(Category $category): void
    {
        QueryAbstraction::execute("UPDATE category SET name = :name, parentCategoryId = :parentId WHERE id = :id", ['name' => $category->name, 'id' => $category->id, 'parentId' => $category->parentCategoryId]);
    }

}
