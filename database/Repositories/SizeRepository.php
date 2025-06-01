<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Size;

/**
 * Repository für @see Size
 */
class SizeRepository
{
    /**
     * Findet eine Größe anhand ihrer ID
     *
     * @param int $id
     * @return Size|null
     */
    public static function findById(int $id): ?Size
    {
        return QueryAbstraction::fetchOneAs(Size::class, "SELECT * FROM size WHERE id = :id", ['id' => $id]);
    }


    /**
     * Findet alle Größen
     *
     * @return array<int, Size>
     */
    public static function findAll(): array
    {
        return QueryAbstraction::fetchManyAs(Size::class, "SELECT * FROM size");
    }

    /**
     * Findet Größen anhand eines Produkttypen
     *
     * @param ProductType $productType
     * @return array<int, Size>
     */
    public static function findByProductType(ProductType $productType): array
    {
        return QueryAbstraction::fetchManyAs(Size::class, "SELECT s.* FROM size s JOIN allowedSize ac ON ac.sizeId = s.id WHERE ac.productTypeId = :productId", ["productId" => $productType->id]);
    }

    /**
     * Findet Größen anhand einer Kategorie
     *
     * @param Category $category
     * @return array<int, Size>
     */
    public static function findByCategory(Category $category): array
    {
        return QueryAbstraction::fetchManyAs(Size::class, "SELECT DISTINCT s.* FROM size s JOIN allowedSize ac ON ac.sizeId = s.id JOIN productType pt ON pt.id = ac.productTypeId WHERE pt.categoryId = :catId", ["catId" => $category->id]);
    }

    /**
     * Erstellt eine Größe
     *
     * @param string $size
     * @return Size|null
     */
    public static function create(string $size): ?Size
    {
        return QueryAbstraction::executeReturning(Size::class, "INSERT INTO size (size) VALUES (:name)", ["name" => $size]);
    }

    /**
     * Aktualisiert eine Größe
     *
     * @param Size $size
     * @return void
     */
    public static function update(Size $size): void
    {
        QueryAbstraction::execute("UPDATE size SET size = :name WHERE id = :id", ["name" => $size->size, "id" => $size->id]);
    }

    /**
     * Löscht eine vorhandene Größe
     *
     * @param int $sizeId Die ID der Größe
     * @return void
     */
    public static function delete(int $sizeId): void
    {
        QueryAbstraction::execute("DELETE FROM size WHERE id = :id", ['id' => $sizeId]);
    }


    /**
     * Prüft, ob eine Größe bereits für Produkttypen verwendet wird
     *
     * @param int $sizeId Die ID der Größe
     * @return bool
     */
    public static function isUsed(int $sizeId): bool
    {
        return QueryAbstraction::fetchOneAs(null, "SELECT sizeId FROM allowedSize WHERE sizeId = :sizeId", ["sizeId" => $sizeId]) !== null;
    }

}
