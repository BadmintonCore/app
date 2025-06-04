<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\ShoppingCartItemDto;
use Vestis\Database\Models\Account;
use Vestis\Database\Models\ShoppingCart;
use Vestis\Utility\GeneratorUtility;

/**
 * Repository für @see ShoppingCart
 */
class ShoppingCartRepository
{
    /**
     * Lädt alle Warenkörbe eines Nutzers
     *
     * @param Account $account Der Account des Nutzers
     * @return array
     */
    public static function findUserShoppingCarts(Account $account): array
    {
        return QueryAbstraction::fetchManyAs(ShoppingCart::class, "SELECT DISTINCT shoppingCart.* FROM shoppingCart LEFT JOIN shoppingCartMember ON shoppingCart.accId = shoppingCartMember.accId and shoppingCart.cartNumber = shoppingCartMember.cartNumber WHERE shoppingCart.accId = :accId OR shoppingCartMember.userId = :accId ORDER BY isShared, shoppingCart.accId", ['accId' => $account->id]);
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
            'secret' => GeneratorUtility::generateSecret($accountId),
        ];

        QueryAbstraction::execute("INSERT INTO shoppingCart (accId, cartNumber, name, isShared, inviteSecret) VALUES (:accountId, :cartNumber, :name, :isShared, :secret)", $params);
    }

    /**
     * Erstellt einen neuen Eintrag in den Einkaufswagen eines Nutzers
     *
     * @param ShoppingCart $shoppingCart Der Warenkorb
     * @param int $itemId ItemID des zu hinzuzufügenden Items
     * @param int $size Größe des zu hinzuzufügenden Items
     * @param int $color Farbe des zu hinzuzufügenden Items
     * @param int $quantity Anzahl des zu hinzuzufügenden Items
     * @param int $shoppingCartNumber Der zweite Teil des Primärschlüssels
     * @return void
     */
    public static function add(ShoppingCart $shoppingCart, int $itemId, int $size, int $color, int $quantity): void
    {

        $params = [
            "accountId" => $shoppingCart->accId,
            "itemId" => $itemId,
            "size" => $size,
            "color" => $color,
            "cartNumber" => $shoppingCart->cartNumber,
        ];

        for ($i = 0; $i < $quantity; $i++) {
            QueryAbstraction::execute("UPDATE product SET shoppingCartId = :accountId, shoppingCartNumber = :cartNumber WHERE productTypeId = :itemId AND sizeId = :size AND colorId = :color AND shoppingCartId IS NULL AND boughtAt IS NULL LIMIT 1", $params);
        }

    }

    /**
     * Entfernt einen Eintrag aus dem Einkaufswagen
     *
     * @param ShoppingCart $shoppingCart Account des Nutzers
     * @param int $itemId ItemID des zu entfernenden Items
     * @param int $size Größe des zu entfernenden Items
     * @param int $color Farbe des zu entfernenden Items
     * @param int $cartNumber Zweite Teil des Warenkorb-Primärschlüssels
     * @return void
     */
    public static function remove(ShoppingCart $shoppingCart, int $itemId, int $size, int $color): void
    {
        $params = [
            "accountId" => $shoppingCart->accId,
            "itemId" => $itemId,
            "size" => $size,
            "color" => $color,
            "cartNumber" => $shoppingCart->cartNumber,
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
     * @param ShoppingCart $shoppingCart
     * @return int Anzahl der Items in dem Einkaufswagen des Nutzers
     */
    public static function getCountOfItems(ShoppingCart $shoppingCart): int
    {
        $row = QueryAbstraction::fetchOneAs(null, "SELECT COUNT(*) AS count FROM product WHERE shoppingCartId = :accountId AND shoppingCartNumber = :cartNumber AND boughtAt IS NULL", ["accountId" => $shoppingCart->accId, "cartNumber" => $shoppingCart->cartNumber]);

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
        if ($account->id === $shoppingCart->accId) {
            return true;
        }
        $params = [
            'userId' => $account->id,
            'accId' => $shoppingCart->accId,
            'cartNumber' => $shoppingCart->cartNumber,
        ];
        $row = QueryAbstraction::fetchOneAs(null, "SELECT * FROM shoppingCartMember WHERE userId = :userId AND accId = :accId AND cartNumber = :cartNumber", $params);
        return $row !== null;
    }

    /**
     * Löscht einen Warenkorb aus der Datenbank
     *
     * @param int $accId Die ID des Accounts
     * @param int $cartNumber Die nutzerspezifische-ID des Warenkorbs
     * @return void
     */
    public static function delete(int $accId, int $cartNumber): void
    {
        QueryAbstraction::execute("DELETE FROM shoppingCart WHERE accId = :accId AND cartNumber = :cartNumber", ["accId" => $accId, "cartNumber" => $cartNumber]);
    }

    /**
     * Adds a new member to the shopping cart
     *
     * @param Account $account
     * @param ShoppingCart $shoppingCart
     * @return void
     */
    public static function addMemberToCart(Account $account, ShoppingCart $shoppingCart): void
    {
        $params = [
            "userId" => $account->id,
            "accId" => $shoppingCart->accId,
            "cartNumber" => $shoppingCart->cartNumber,
        ];
        QueryAbstraction::execute("INSERT INTO shoppingCartMember (userId, accId, cartNumber) VALUES (:userId, :accId, :cartNumber)", $params);
    }

    /**
     * Removes a member from a shopping cart.
     *
     * @param Account $account
     * @param ShoppingCart $shoppingCart
     * @return void
     */
    public static function removeMemberFromCart(Account $account, ShoppingCart $shoppingCart): void
    {
        $params = [
            "userId" => $account->id,
            "accId" => $shoppingCart->accId,
            "cartNumber" => $shoppingCart->cartNumber,
        ];
        QueryAbstraction::execute("DELETE FROM shoppingCartMember WHERE userId = :userId AND accId = :accId AND cartNumber = :cartNumber", $params);
    }

    /**
     * Findet alle Mitglieder eines Warenkorbes
     *
     * @param ShoppingCart $shoppingCart
     * @return array<int, Account>
     */
    public static function findMembersForCart(ShoppingCart $shoppingCart): array
    {
        $params = [
            "accId" => $shoppingCart->accId,
            "cartNumber" => $shoppingCart->cartNumber,
        ];
        return QueryAbstraction::fetchManyAs(Account::class, "SELECT account.* FROM account JOIN shoppingCartMember sCM on account.id = sCM.userId WHERE accId = :accId AND cartNumber = :cartNumber", $params);
    }

    /**
     * Entfernt ein Mitglied aus dem Warenkorb
     *
     * @param ShoppingCart $shoppingCart
     * @param int $userId
     * @return void
     */
    public static function removeMember(ShoppingCart $shoppingCart, int $userId): void
    {
        $params = [
            "userId" => $userId,
            "accId" => $shoppingCart->accId,
            "cartNumber" => $shoppingCart->cartNumber,
        ];
        QueryAbstraction::execute("DELETE FROM shoppingCartMember WHERE userId = :userId AND cartNumber = :cartNumber AND accId = :accId", $params);
    }
}
