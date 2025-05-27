<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Size;

class SizeRepository
{
    /**
     * @param ProductType $productType
     * @return array<int, Size>
     */
    public static function findByProductType(ProductType $productType): array
    {
        return QueryAbstraction::fetchManyAs(Size::class, "SELECT s.* FROM size s JOIN allowedSize ac ON ac.sizeId = s.id WHERE ac.productTypeId = :productId", ["productId" => $productType->id]);
    }

}
