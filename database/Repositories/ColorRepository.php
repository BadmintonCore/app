<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;

class ColorRepository
{

    /**
     * @param ProductType $productType
     * @return array<int, Color>
     */
    public static function findByProductType(ProductType $productType): array
    {
        return QueryAbstraction::fetchManyAs(Color::class, "SELECT c.* FROM color c JOIN allowedColor ac ON ac.colorId = c.id WHERE ac.productTypeId = :productId", ["productId" => $productType->id]);
    }

}