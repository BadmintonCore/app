<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Account;
use Vestis\Database\Models\Order;
use Vestis\Database\Models\OrderStatus;

/**
 * Repository für @see Order
 */
class OrderRepository
{
    /**
     * Lädt einen Auftrag anhand der ID
     *
     * @param int $id
     * @return Order|null
     */
    public static function findById(int $id): ?Order
    {
        return QueryAbstraction::fetchOneAs(Order::class, "SELECT * FROM orders WHERE id = :id", ["id" => $id]);
    }

    /**
     * Lädt Aufträge paginiert
     *
     * @param OrderStatus $status
     * @param int $page Die Seite, die geladen werden soll
     * @param int $perPage Die Anzahl an Elementen pro Seite
     * @return PaginationDto<Order>
     */
    public static function findPaginatedWithStatus(OrderStatus $status, int $page, int $perPage): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(Order::class, "SELECT * FROM orders WHERE status = :status ORDER BY id DESC", $page, $perPage, ['status' => $status->value]);
    }

    /**
     * Lädt Aufträge paginiert eines Nutzers
     *
     * @param Account $account Der Account dessen Aufträge geladen werden sollen
     * @param int $page Die Seite, die geladen werden soll
     * @param int $perPage Die Anzahl an Elementen pro Seite
     * @return PaginationDto<Order>
     */
    public static function findPaginatedForUser(Account $account, int $page, int $perPage): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(Order::class, "SELECT * FROM orders WHERE accountId = :accId ORDER BY id DESC", $page, $perPage, ["accId" => $account->id]);
    }

    /**
     * Erstellt einen neuen Auftrag
     *
     * @param Account $account Der Account, dem der Auftrag zugewiesen ist
     * @param string $status Der Status des neuen Auftrages
     * @return Order|null
     */
    public static function create(Account $account, string $status): ?Order
    {
        return QueryAbstraction::executeReturning(Order::class, "INSERT INTO orders (accountId, timestamp, status) VALUES(:accountId, NOW(), :status)", ["accountId" => $account->id, "status" => $status]);
    }

    /**
     * Aktualisiert den Status einer Bestellung
     *
     * @param int $orderId Die ID der Bestellung
     * @param OrderStatus $status Der neue Status
     * @return void
     */
    public static function updateStatus(int $orderId, OrderStatus $status): void
    {
        QueryAbstraction::execute("UPDATE orders SET status = :status WHERE id = :id", ["status" => $status->value, "id" => $orderId]);
    }

    /**
     * Setzt die denial-Nachricht im Falle einer Ablehnung.
     *
     * @param int $orderId Die ID des Auftrages
     * @param string $message Die Nachricht
     * @return void
     */
    public static function setDenialMessage(int $orderId, string $message): void
    {
        QueryAbstraction::execute("UPDATE orders SET denialMessage = :message WHERE id = :id", ["message" => $message, "id" => $orderId]);
    }

    /**
     * Lädt die Anzahl an Bestellungen pro Benutzer
     *
     * @param Account $account Der Benutzer dessen Anzahl an Bestellungen geladen werden soll
     * @return int
     */
    public static function getCountOfOrdersForAccount(Account $account): int
    {
        $query = "SELECT COUNT(*) as orderCount FROM orders WHERE accountId = :accountId";
        $result = QueryAbstraction::fetchOneAs(null, $query, ['accountId' => $account->id]);

        return (int)($result['orderCount'] ?? 0);
    }

    /**
     * Speichert den Rabatt einer Bestellung
     *
     * @param int $orderId Die ID der Bestellung
     * @param float $discount Der Rabatt der Bestellung.
     * @param string $message Die Nachricht der Rabattaktion
     * @return void
     */
    public static function saveDiscount(int $orderId, float $discount, string $message): void
    {
        $query = "UPDATE orders SET discount = :discount, discountMessage = :message WHERE id = :orderId";
        QueryAbstraction::execute($query, [
            'discount' => $discount,
            'message' => $message,
            'orderId' => $orderId,
        ]);
    }

}
