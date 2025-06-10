<?php

namespace Vestis\Database\Models;

use Vestis\Database\Repositories\QueryAbstraction;

/**
 * Das Model für einen Account in der Datenbank
 */
class Account
{
    public int $id;

    public AccountType $type;

    public string $firstname;

    public string $surname;

    public string $username;

    public string $email;

    public string $password;

    public bool $isBlocked;


    public function getOrderCountByAccount() : int
    {
        // Hier wird die Anzahl der Bestellungen für diesen Account abgefragt
        $accountId = $this->id;

        $query = "SELECT COUNT(*) as orderCount FROM orders WHERE accountId = :accountId";
        $result = QueryAbstraction::fetchOneAs(null, $query, ['accountId' => $accountId]);

        return $result['orderCount'] ?? 0;
    }
}
