<?php

//Autor(en): Lasse Hoffmann

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;
use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;

/**
 * Repository für @see Color
 */
class ColorRepository
{
    /**
     * Findet eine Farbe anhand ihrer ID
     *
     * @param int $id
     * @return Color|null
     */
    public static function findById(int $id): ?Color
    {
        return QueryAbstraction::fetchOneAs(Color::class, "SELECT * FROM color WHERE id = :id", ['id' => $id]);
    }


    /**
     * Gibt alle Farben zurück
     *
     * @return array<int, Color>
     */
    public static function findAll(): array
    {
        return QueryAbstraction::fetchManyAs(Color::class, "SELECT * FROM color");
    }

    /**
     * Findet Kategorien anhand ihres Produkttypen
     *
     * @param ProductType $productType
     * @return array<int, Color>
     */
    public static function findByProductType(ProductType $productType): array
    {
        return QueryAbstraction::fetchManyAs(Color::class, "SELECT c.* FROM color c JOIN allowedColor ac ON ac.colorId = c.id WHERE ac.productTypeId = :productId", ["productId" => $productType->id]);
    }

    /**
     * Findet Farben anhand einer Kategorie
     * HINWEIS: Dabei wird über den Produkttypen gejoined
     *
     * @param Category $category
     * @return array<int, Color>
     */
    public static function findByCategory(Category $category): array
    {
        return QueryAbstraction::fetchManyAs(Color::class, "SELECT DISTINCT c.* FROM color c JOIN allowedColor ac ON ac.colorId = c.id JOIN productType pt ON pt.id = ac.productTypeId WHERE pt.categoryId = :catId", ["catId" => $category->id]);
    }

    /**
     * Erstellt eine neue Farbe in der Datenbank
     *
     * @param string $name Der Name der Farbe
     * @param string $hex Der HEX-Wert der Farbe
     * @return Color|null
     */
    public static function create(string $name, string $hex): ?Color
    {
        return QueryAbstraction::executeReturning(Color::class, "INSERT INTO color (name, hex) VALUES (:name, :hex)", ["name" => $name, "hex" => $hex]);
    }

    /**
     * Aktualisiert eine Farbe
     *
     * @param Color $color
     * @return void
     */

    public static function update(Color $color): void
    {
        QueryAbstraction::execute("UPDATE color SET name = :name, hex = :hex WHERE id = :id", ["name" => $color->name, "id" => $color->id, "hex" => $color->hex]);
    }

    /**
     * Löscht eine vorhandene Farbe
     *
     * @param int $colorId Die ID der Farbe
     * @return void
     */
    public static function delete(int $colorId): void
    {
        QueryAbstraction::execute("DELETE FROM color WHERE id = :id", ["id" => $colorId]);
    }

    /**
     * Prüft, ob eine Farbe bereits für Produkttypen verwendet wird
     *
     * @param int $colorId Die ID der Farbe
     * @return bool
     */
    public static function isUsed(int $colorId): bool
    {
        return QueryAbstraction::fetchOneAs(null, "SELECT colorId FROM allowedColor WHERE colorId = :colorId", ["colorId" => $colorId]) !== null;
    }

}
//Autor(en): Lasse Hoffmann
