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
 * Der Typ, den ein Benutzeraccount haben kann {@see Account::$type}
 */

// BackedEnum, da enum einen speziellen Typ angegeben hat (hier: String)
enum AccountType: string
{
    case Customer = "C";
    case Administrator = "A";
}
