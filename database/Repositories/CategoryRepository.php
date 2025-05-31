<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;

/**
 * Repository für @see Category
 */
class CategoryRepository
{
    /**
     * Gibt alle Kategorien zurück
     *
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
     * Überprüft, ob eine Kategorie eine Eltern-Kategorie hat.
     *
     * @param int $categoryId
     * @return bool
     */
    public static function hasParent(int $categoryId): bool
    {
        return QueryAbstraction::fetchOneAs(Category::class, "SELECT id FROM category WHERE parentCategoryId IS NOT NULL AND id = :id", ['id' => $categoryId]) !== null;
    }

    /**
     * Überprüft, ob eine Kategorie Kinder-Kategorien hat.
     *
     * @param int $categoryId
     * @return bool
     */
    public static function hasChild(int $categoryId): bool
    {
        return QueryAbstraction::fetchOneAs(Category::class, "SELECT id FROM category WHERE parentCategoryId = :id", ['id' => $categoryId]) !== null;
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

    /**
     * Erstellt eine Kategorie
     *
     * @param string $name Der Name der Kategorie
     * @param int|null $parentCategoryId Die ID der übergeordneten Kategorie
     * @return Category|null
     */
    public static function create(string $name, ?int $parentCategoryId): ?Category
    {
        return QueryAbstraction::executeReturning(Category::class, "INSERT INTO category (name, parentCategoryId) VALUES (:name, :parentCategoryId)", ["name" => $name, "parentCategoryId" => $parentCategoryId]);
    }

    /**
     * Aktualisiert eine Kategorie.
     *
     * @param Category $category Die Kategorie, mit lokal geänderten Parametern
     * @return void
     */
    public static function update(Category $category): void
    {
        QueryAbstraction::execute("UPDATE category SET name = :name, parentCategoryId = :parentId WHERE id = :id", ['name' => $category->name, 'id' => $category->id, 'parentId' => $category->parentCategoryId]);
    }

    /**
     * Löscht eine Kategorie.
     *
     * @param int $categoryId
     * @return void
     */
    public static function delete(int $categoryId): void
    {
        QueryAbstraction::execute("DELETE FROM category WHERE id = :id", ['id' => $categoryId]);
    }

}
