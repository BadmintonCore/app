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
     * Lädt alle Warenkörbe eines Nutzers, die er direkt besitzt.
     *
     * @param Account $account Der Account des Nutzers
     * @return array
     */
    public static function findUserOwnedShoppingCarts(Account $account): array
    {
        return QueryAbstraction::fetchManyAs(ShoppingCart::class, "SELECT * FROM shoppingCart WHERE accId = :accId", ['accId' => $account->id]);
    }

    /**
     * Findet einen bestimmten Warenkorb
     *
     * @param int $accountId Die ID des Account
     * @param int $cartNumber Der zweite Teil des Primärschlüssels
     * @return ShoppingCart|null
     */
    public static function findShoppingCart(int $accountId, int $cartNumber): ?ShoppingCart
    {
        return QueryAbstraction::fetchOneAs(ShoppingCart::class, "SELECT * FROM shoppingCart WHERE accId = :accId AND cartNumber = :cartNumber", ['accId' => $accountId, 'cartNumber' => $cartNumber]);
    }


    /**
     * Erstellt einen Einkaufswagen für einen Nutzer
     *
     * @param int $accountId Account-ID des Nutzers
     * @param string|null $name Der Name des Einkaufswagens
     * @param bool $isShared Ob der Einkaufswagen geteilt werden kann.
     * @return void
     */
    public static function create(int $accountId, ?string $name = null, bool $isShared = false): void
    {

        $row = QueryAbstraction::fetchOneAs(null, "SELECT MAX(cartNumber) as max FROM shoppingCart WHERE accId = :accId", ['accId' => $accountId]);
        $cartNumber = 1;
        if ($row !== null) {
            $cartNumber = $row['max'] + 1;
        }

        $params = [
            'accountId' => $accountId,
            'name' => $name,
            'isShared' => $isShared,
            'cartNumber' => $cartNumber,
        ];

        QueryAbstraction::execute("INSERT INTO shoppingCart (accId, cartNumber, name, isShared) VALUES (:accountId, :cartNumber, :name, :isShared)", $params);
    }

    /**
     * Erstellt einen neuen Eintrag in den Einkaufswagen eines Nutzers
     *
     * @param Account $account Account des Nutzers
     * @param int $itemId ItemID des zu hinzuzufügenden Items
     * @param int $size Größe des zu hinzuzufügenden Items
     * @param int $color Farbe des zu hinzuzufügenden Items
     * @param int $quantity Anzahl des zu hinzuzufügenden Items
     * @param int $shoppingCartNumber Der zweite Teil des Primärschlüssels
     * @return void
     */
    public static function add(Account $account, int $itemId, int $size, int $color, int $quantity, int $shoppingCartNumber = 1): void
    {

        $params = [
            "accountId" => $account->id,
            "itemId" => $itemId,
            "size" => $size,
            "color" => $color,
            "cartNumber" => $shoppingCartNumber,
        ];

        for ($i = 0; $i < $quantity; $i++) {
            QueryAbstraction::execute("UPDATE product SET shoppingCartId = :accountId, shoppingCartNumber = :cartNumber WHERE productTypeId = :itemId AND sizeId = :size AND colorId = :color AND shoppingCartId IS NULL AND boughtAt IS NULL LIMIT 1", $params);
        }

    }

    /**
     * Entfernt einen Eintrag aus dem Einkaufswagen
     *
     * @param Account $account Account des Nutzers
     * @param int $itemId ItemID des zu entfernenden Items
     * @param int $size Größe des zu entfernenden Items
     * @param int $color Farbe des zu entfernenden Items
     * @param int $cartNumber Zweite Teil des Warenkorb-Primärschlüssels
     * @return void
     */
    public static function remove(Account $account, int $itemId, int $size, int $color, int $cartNumber = 1): void
    {
        $params = [
            "accountId" => $account->id,
            "itemId" => $itemId,
            "size" => $size,
            "color" => $color,
            "cartNumber" => $cartNumber,
        ];

        QueryAbstraction::execute("UPDATE product SET shoppingCartId = NULL, shoppingCartNumber = NULL WHERE productTypeId = :itemId AND shoppingCartId = :accountId AND shoppingCartNumber = :cartNumber  AND colorId = :color AND sizeId = :size AND boughtAt IS NULL", $params);
    }

    /**
     * Gibt alle Produkte aus dem Einkaufswagen eines Nutzers zurück
     *
     * @param ShoppingCart $shoppingCart Der Einkaufswagen
     * @return ShoppingCartItemDto[] Array mit allen Items des Einkaufswagens
     */
    public static function getAllProducts(ShoppingCart $shoppingCart): array
    {
        return QueryAbstraction::fetchManyAs(ShoppingCartItemDto::class, "SELECT product.*, COUNT(productTypeId) AS count FROM product WHERE shoppingCartId = :accountId AND shoppingCartNumber = :cartNumber AND boughtAt IS NULL GROUP BY productTypeId, colorId, sizeId", ["accountId" => $shoppingCart->accId, "cartNumber" => $shoppingCart->cartNumber]);
    }

    /**
     * Entfernt einen Eintrag aus dem Einkaufswagen
     *
     * @param Account $account Account des Nutzers
     * @param int $cartNumber Der zweite Teil des Primärschlüssels
     * @return int Anzahl der Items in dem Einkaufswagen des Nutzers
     */
    public static function getCountOfItems(Account $account, int $cartNumber = 1): int
    {
        $row = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(*) AS count FROM product WHERE shoppingCartId = :accountId AND shoppingCartNumber = :cartNumber AND boughtAt IS NULL", ["accountId" => $account->id, "cartNumber" => $cartNumber]);

        /**@var int */
        return (int) ($row['count'] ?? 0);
    }

    /**
     * Prüft, ob ein bestimmter Nutzer Zugriff auf einen bestimmten Warenkorb hat.
     *
     * @param Account $account Der zugreifende Nutzer
     * @param ShoppingCart $shoppingCart Der Warenkorb
     * @return bool
     */
    public static function hasAccessTo(Account $account, ShoppingCart $shoppingCart): bool
    {
        $params = [
            'userId' => $account->id,
            'accId' => $shoppingCart->accId,
            'cartNumber' => $shoppingCart->cartNumber,
        ];
        $row = QueryAbstraction::fetchOneAs(null, "SELECT * FROM shoppingCartMember WHERE userId = :userId AND accId = :accId AND cartNumber = :cartNumber", $params);
        return $row !== null;
    }
}
