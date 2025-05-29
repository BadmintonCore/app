<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;
use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;

class ColorRepository
{
    public static function findById(int $id): ?Color
    {
        return QueryAbstraction::fetchOneAs(Color::class, "SELECT * FROM color WHERE id = :id", ['id' => $id]);
    }


    /**
     * @return array<int, Color>
     */
    public static function findAll(): array
    {
        return QueryAbstraction::fetchManyAs(Color::class, "SELECT * FROM color");
    }

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

    public static function create(string $name, string $hex): Color
    {
        return QueryAbstraction::executeReturning(Color::class, "INSERT INTO color (name, hex) VALUES (:name, :hex)", ["name" => $name, "hex" => $hex]);
    }

    public static function update(Color $color)
    {
        QueryAbstraction::execute("UPDATE color SET name = :name, hex = :hex WHERE id = :id", ["name" => $color->name, "id" => $color->id, "hex" => $color->hex]);
    }

}
