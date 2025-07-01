<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

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
     * Gibt alle Kategorien zurück, die keine Eltern-Kategorie haben
     *
     * @return array<int, Category>
     */
    public static function findAllWithNoParent(): array
    {
        return QueryAbstraction::fetchManyAs(Category::class, "SELECT * FROM category WHERE parentCategoryId IS NULL");
    }

    /**
     * Gibt alle Kategorien zurück, die eine Eltern-Kategorie haben
     *
     * @return array<int, Category>
     */
    public static function findAllWithParent(): array
    {
        return QueryAbstraction::fetchManyAs(Category::class, "SELECT * FROM category WHERE parentCategoryId IS NOT NULL");
    }

    /**
     * Gibt alle Kategorien zurück, die keine Eltern-Kategorie haben und nicht die übergebene Kategorie-ID selbst sind
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
     * Gibt eine Kategorie anhand ihrer ID zurück
     *
     * @param int $id Die Kategorie-ID
     * @return Category|null Die Kategorie
     */
    public static function findById(int $id): ?Category
    {
        return QueryAbstraction::fetchOneAs(Category::class, "SELECT * FROM category WHERE id = :id", ['id' => $id]);
    }

    /**
     * Überprüft, ob eine Kategorie eine Eltern-Kategorie hat
     *
     * @param int $categoryId Die Kategorie-ID
     * @return bool
     */
    public static function hasParent(int $categoryId): bool
    {
        return QueryAbstraction::fetchOneAs(Category::class, "SELECT id FROM category WHERE parentCategoryId IS NOT NULL AND id = :id", ['id' => $categoryId]) !== null;
    }

    /**
     * Überprüft, ob eine Kategorie Kinder-Kategorien hat
     *
     * @param int $categoryId Die Kategorie-ID
     * @return bool
     */
    public static function hasChildren(int $categoryId): bool
    {
        return QueryAbstraction::fetchOneAs(Category::class, "SELECT id FROM category WHERE parentCategoryId = :id", ['id' => $categoryId]) !== null;
    }

    /**
     * Findet Kategorien anhand einer Eltern-Kategorie
     *
     * @param int $id Die Eltern-Kategorie-ID
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
     * Aktualisiert eine Kategorie
     *
     * @param Category $category Die Kategorie, mit lokal geänderten Parametern
     * @return void
     */
    public static function update(Category $category): void
    {
        QueryAbstraction::execute("UPDATE category SET name = :name, parentCategoryId = :parentId WHERE id = :id", ['name' => $category->name, 'id' => $category->id, 'parentId' => $category->parentCategoryId]);
    }

    /**
     * Löscht eine Kategorie
     *
     * @param int $categoryId
     * @return void
     */
    public static function delete(int $categoryId): void
    {
        QueryAbstraction::execute("DELETE FROM category WHERE id = :id", ['id' => $categoryId]);
    }

}
