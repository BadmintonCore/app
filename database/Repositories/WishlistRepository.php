<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\WishlistItemDto;

class WishlistRepository
{
    public static function getWishlistByAccountId(int $accountId): array
    {
        return QueryAbstraction::fetchManyAs(WishlistItemDto::class, "SELECT wishlist.productTypeId, productType.id as productTypeId, productType.name, productType.price, wishlist.timestamp FROM wishlist JOIN productType ON wishlist.productTypeId = productType.id WHERE wishlist.accId = :accId", ['accId' => $accountId]);
    }

    public static function removeFromWishlist(int $accountId, int $productTypeId): void
    {
        QueryAbstraction::execute("DELETE FROM  wishlist WHERE accId = :accId AND productTypeId = :productTypeId", ['accId' => $accountId, 'productTypeId' => $productTypeId]);
    }

    public static function addToWishlist(int $accountId, int $productTypeId): void
    {
        QueryAbstraction::execute("INSERT INTO wishlist (accId, productTypeId, timestamp) VALUES (:accId, :productTypeId, NOW())", ['accId' => $accountId, 'productTypeId' => $productTypeId]);
    }
}
