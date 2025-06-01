<?php

namespace Vestis\Database\Models;

/**
 * Das Model für einen Account in der DB
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
}
