<?php

namespace Vestis\Database\Repositories;

class ProductRepository
{
    public static function getProductQuantityNotInShoppingCart($itemId): int
    {
        $statement = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(*) AS count FROM product WHERE productTypeId = :itemId AND shoppingCartId IS NULL", ["itemId" => $itemId]);

        return (int)($statement['count'] ?? 1);
    }
}
