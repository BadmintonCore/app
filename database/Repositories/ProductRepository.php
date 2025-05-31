<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Product;

/**
 * Repository für @see Product
 */
class ProductRepository
{

    /**
     * Lädt Produkte mit eines bestimmten Produkt-Typen paginiert
     *
     * @param int $productTypeId Die ID des Produkt-Typen
     * @param int $page Die Seite, die geladen werden soll
     * @param int $perPage Die Anzahl an Elementen pro Seite
     * @return PaginationDto<Product>
     */
    public static function findForTypePaginated(int $productTypeId, int $page, int $perPage): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(Product::class, "SELECT * FROM product WHERE productTypeId = :productTypeId ORDER BY id DESC", $page, $perPage, ["productTypeId" => $productTypeId]);
    }

    public static function create(int $productTypeId, int $colorId, int $sizeId, int $quantity): void
    {
        if ($quantity <= 0) {
            return;
        }

        $batchSize = 100;

        // Wir nutzen hier mehrere Batches, falls die Quantity das MariaDB Query Limit überschreiten sollte.
        for ($offset = 0; $offset < $quantity; $offset += $batchSize) {
            $currentBatchSize = min($batchSize, $quantity - $offset);
            $placeholders = [];
            $params = [];

            for ($i = 0; $i < $currentBatchSize; $i++) {
                $index = $offset + $i;
                $placeholders[] = "(:productTypeId{$index}, :colorId{$index}, :sizeId{$index})";
                $params["productTypeId{$index}"] = $productTypeId;
                $params["colorId{$index}"] = $colorId;
                $params["sizeId{$index}"] = $sizeId;
            }

            $query = "INSERT INTO product (productTypeId, colorId, sizeId) VALUES " . implode(', ', $placeholders);
            QueryAbstraction::execute($query, $params);
        }
    }
}