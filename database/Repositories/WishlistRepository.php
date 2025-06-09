<?php

/* Autor(en): Lasse Hoffmann */

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\WishlistItemDto;

/**
 * Repository für @see Wishlist
 */
class WishlistRepository
{
    /**
     * Findet alle Einträge einer Wunschliste mit der AccountID eines Benutzers
     *
     * @param int $accountId Die AccountID des Benutzers
     * @return array<WishlistItemDto> Gibt ein Array mit allen WishListItems zurück
     */
    public static function getWishlistByAccountId(int $accountId): array
    {
        return QueryAbstraction::fetchManyAs(WishlistItemDto::class, "SELECT wishlist.productTypeId, productType.name, productType.price, wishlist.timestamp FROM wishlist JOIN productType ON wishlist.productTypeId = productType.id WHERE wishlist.accId = :accId", ['accId' => $accountId]);
    }

    /**
     * Fügt einen Eintrag zur Wunschliste eines Benutzers hinzu
     *
     * @param int $accountId Die AccountID des Benutzers
     * @param int $productTypeId Die ProdukttypID
     * @return void
     */
    public static function addToWishlist(int $accountId, int $productTypeId): void
    {
        QueryAbstraction::execute("INSERT INTO wishlist (accId, productTypeId, timestamp) VALUES (:accId, :productTypeId, NOW())", ['accId' => $accountId, 'productTypeId' => $productTypeId]);
    }

    /**
     * Entfernt einen Eintrag aus der Wunschliste eines Benutzers
     *
     * @param int $accountId Die AccountID des Benutzers
     * @param int $productTypeId Die ProdukttypID
     * @return void
     */
    public static function removeFromWishlist(int $accountId, int $productTypeId): void
    {
        QueryAbstraction::execute("DELETE FROM  wishlist WHERE accId = :accId AND productTypeId = :productTypeId", ['accId' => $accountId, 'productTypeId' => $productTypeId]);
    }
}
/* Autor(en): Lasse Hoffmann */
