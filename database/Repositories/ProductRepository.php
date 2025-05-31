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

}