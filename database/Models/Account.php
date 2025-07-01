<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Database\Models;

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
}
