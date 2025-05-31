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
    /**
     * Erstellt einen Einkaufswagen für einen Nutzer
     *
     * @param int $accountId AccountID des Nutzers
     * @return void
     */
    public static function create(int $accountId): void
    {

        $params = [
            'accountId' => $accountId,
        ];

        QueryAbstraction::execute("INSERT INTO shoppingCart (accId) VALUES (:accountId)", $params);
    }

    /**
     * Erstellt einen neuen Eintrag in den Einkaufswagen eines Nutzers
     *
     * @param Account $account Account des Nutzers
     * @param int $itemId ItemID des zu hinzuzufügenden Items
     * @param int $size Größe des zu hinzuzufügenden Items
     * @param int $color Farbe des zu hinzuzufügenden Items
     * @param int $quantity Anzahl des zu hinzuzufügenden Items
     * @return void
     */
    public static function add(Account $account, int $itemId, int $size, int $color, int $quantity): void
    {

        $params = [
            "accountId" => $account->id,
            "itemId" => $itemId,
            "size" => $size,
            "color" => $color,
        ];

        for ($i = 0; $i < $quantity; $i++) {
            QueryAbstraction::execute("UPDATE product SET shoppingCartId = :accountId WHERE productTypeId = :itemId AND sizeId = :size AND colorId = :color AND shoppingCartId IS NULL AND boughtAt IS NULL LIMIT 1", $params);
        }

    }

    /**
     * Entfernt einen Eintrag aus dem Einkaufswagen
     *
     * @param Account $account Account des Nutzers
     * * @param int $itemId ItemID des zu entfernenden Items
     * * @param int $size Größe des zu entfernenden Items
     * * @param int $color Farbe des zu entfernenden Items
     * @return void
     */
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

    /**
     * Ermittelt die Anzahl eines Produktes in der Datenbank (gleiche ItemIT, Farbe und Größe))
     *
     * @param int $itemId ItemID des Items
     * @param int $size Größe des Items
     * @param int $color Farbe des Items
     * @return int Anzahl der verfügbaren Produkte
     */
    public static function getAmountOfProducts(int $itemId, int $size, int $color): int
    {

        $params = [
            "itemId" => $itemId,
            "size" => $size,
            "color" => $color,
        ];

        $statement = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(*) AS count FROM product WHERE productTypeId = :itemId AND sizeId = :size AND colorId = :color AND shoppingCartId IS NULL AND boughtAt IS NULL", $params);

        /**@var int */
        return (int) ($statement['count'] ?? 0);
    }

    /**
     * Gibt alle Produkte aus dem Einkaufswagen eines Nutzers zurück
     *
     * @param Account $account Account des Nutzers
     * @return ShoppingCartItemDto[] Array mit allen Items des Einkaufswagens
     */
    public static function getAllProducts(Account $account): array
    {
        return QueryAbstraction::fetchManyAs(ShoppingCartItemDto::class, "SELECT product.*, COUNT(productTypeId) AS count FROM product WHERE shoppingCartId = :accountId AND boughtAt IS NULL GROUP BY productTypeId, colorId, sizeId", ["accountId" => $account->id]);
    }

    /**
     * Entfernt einen Eintrag aus dem Einkaufswagen
     *
     * @param Account $account Account des Nutzers
     * @return int Anzahl der Items in dem Einkaufswagen des Nutzers
     */
    public static function getCountOfItems(Account $account): int
    {
        $row = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(*) AS count FROM product WHERE shoppingCartId = :accountId AND boughtAt IS NULL", ["accountId" => $account->id]);

        /**@var int */
        return (int) ($row['count'] ?? 0);
    }
}
