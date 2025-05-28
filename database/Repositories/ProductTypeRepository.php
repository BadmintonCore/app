<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Category;
use Vestis\Database\Models\ProductType;

class ProductTypeRepository
{
    /**
     * @param Category $category The category that should be used to fetch product types
     * @param int $maxPrice The maximum allowed price
     * @return array<int, ProductType>
     */
    public static function findByParams(Category $category, int $maxPrice, array $allowedColorIds, array $allowedSizeIds, ?string $search): array
    {

        $hasColorFilter = count($allowedColorIds) > 0;
        $hasSizeFilter = count($allowedSizeIds) > 0;
        $params = [
            'catId' => $category->id,
            'maxPrice' => $maxPrice,
            'search' => $search ? '%' . $search . '%' : null,
        ];


        // Parameter existiert nur, wenn auch der Farbfilter aktiv ist
        if ($hasColorFilter) {
            $params['allowedColors'] = $allowedColorIds;
        }

        // Parameter existiert nur, wenn auch der Größenfilter aktiv ist
        if ($hasSizeFilter) {
            $params['allowedSizes'] = $allowedSizeIds;
        }
        return QueryAbstraction::fetchManyAs(
            ProductType::class,
           sprintf(
            "SELECT DISTINCT p.* FROM productType p JOIN allowedSize az ON az.productTypeId = p.id JOIN allowedColor ac ON ac.productTypeId = p.id WHERE categoryId = :catId AND price <= :maxPrice %s %s AND (:search IS NULL OR description LIKE :search OR name LIKE :search OR collection LIKE :search)",
               $hasColorFilter ? 'AND ac.colorId IN :allowedColors' : '',
               $hasSizeFilter ? 'AND az.sizeId IN :allowedSizes ' : ''
           ),
            $params
        );
    }

    public static function findById(int $id): ?ProductType
    {
        return QueryAbstraction::fetchOneAs(ProductType::class, "SELECT DISTINCT * FROM productType WHERE id = :id", ["id" => $id]);
    }

    /**
     * @param Category $category
     * @return array<string, int|bool|string|null>
     */
    public static function findMinAndMaxPricesByCategory(Category $category): array
    {
        return QueryAbstraction::fetchOneAs(null, "SELECT DISTINCT MIN(price) as min, MAX(price) as max FROM productType WHERE categoryId = :catId", ["catId" => $category->id]);
    }

}
