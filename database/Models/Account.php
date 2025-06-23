<?php

namespace Vestis\Database\Models;

/**
 * Das Model für einen Account in der Datenbank
 */
class Account
{
    public int $id = 0;

    public AccountType $type = AccountType::Customer;

    public string $firstname = "";

    public string $surname = "";

    public string $username = "";

    public string $email = "";

    public string $password = "";

    public bool $isBlocked = false;
}
