<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Account;
use Vestis\Database\Models\Order;

/**
 * Repository für @see Order
 */
class OrderRepository
{

    public static function create(Account $account, string $status): Order
    {
        return QueryAbstraction::executeReturning(Order::class, "INSERT INTO orders (accountId, timestamp, status) VALUES(:accountId, NOW(), :status)", ["accountId" => $account->id, "status" => $status]);
    }

}