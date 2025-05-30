<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Dto\ShoppingCartItemDto;
use Vestis\Database\Models\Account;
use Vestis\Database\Models\Category;
use Vestis\Database\Models\Product;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\ShoppingCart;

/**
 * Repository für @see ShoppingCart
 */
class ShoppingCartRepository
{
    public static function create(int $accountId): void
    {

        $params = [
            'accountId' => $accountId,
        ];

        QueryAbstraction::execute("INSERT INTO shoppingCart (accId) VALUES (:accountId)", $params);
    }

    public static function add(Account $account, int $itemId, int $size, int $color, int $quantity): void
    {

        $params = [
            "accountId" => $account->id,
            "itemId" => $itemId,
            "size" => $size,
            "color" => $color,
        ];

        $statement = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(*) AS count FROM product WHERE productTypeId = :itemId AND shoppingCartId IS NULL AND boughtAt IS NULL", ["itemId" => $itemId]);

        $pieces = (int)($statement['count'] ?? 0);

        //Nur, wenn genug Produkte verfügbar sind, wird was in den Warenkorb hinzugefügt
        if ($pieces >= $quantity) {
            for ($i = 0; $i < $quantity; $i++) {
                QueryAbstraction::execute("UPDATE product SET shoppingCartId = :accountId WHERE productTypeId = :itemId AND sizeId = :size AND colorId = :color AND shoppingCartId IS NULL AND boughtAt IS NULL LIMIT 1", $params);
            }
        }

    }

    public static function remove(Account $account, int $itemId, int $size, int $color): void
    {
        $params = [
            "accountId" => $account->id,
            "itemId" => $itemId,
            "size" => $size,
            "color" => $color,
        ];

        QueryAbstraction::execute("UPDATE product SET shoppingCartId = NULL WHERE productTypeId = :itemId AND shoppingCartId = :accountId  AND colorId = :color AND sizeId = :size AND boughtAt IS NULL", $params);
    }

    /** @return ShoppingCartItemDto[] */
    public static function getAllProducts(Account $account): array
    {
        return QueryAbstraction::fetchManyAs(ShoppingCartItemDto::class, "SELECT product.*, COUNT(productTypeId) AS count FROM product WHERE shoppingCartId = :accountId AND boughtAt IS NULL GROUP BY productTypeId, colorId, sizeId", ["accountId" => $account->id]);
    }

    public static function getCountOfItems(Account $account): int
    {
        $row = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(*) AS count FROM product WHERE shoppingCartId = :accountId AND boughtAt IS NULL", ["accountId" => $account->id]);

        return (int)($row['count'] ?? 0);
    }
}
