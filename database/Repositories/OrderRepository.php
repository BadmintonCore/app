<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Account;
use Vestis\Database\Models\Order;

/**
 * Repository für @see Order
 */
class OrderRepository
{

    /**
     * Lädt Aufträge paginiert
     *
     * @param int $page Die Seite, die geladen werden soll
     * @param int $perPage Die Anzahl an Elementen pro Seite
     * @return PaginationDto<Order>
     */
    public static function findPaginated(int $page, int $perPage): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(Order::class, "SELECT * FROM orders ORDER BY id DESC", $page, $perPage);
    }

    public static function create(Account $account, string $status): Order
    {
        return QueryAbstraction::executeReturning(Order::class, "INSERT INTO orders (accountId, timestamp, status) VALUES(:accountId, NOW(), :status)", ["accountId" => $account->id, "status" => $status]);
    }

}