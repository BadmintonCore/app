<?php

namespace Vestis\Database\Models;

/**
 * The type a user account can have {@see Account::$type}
 */
enum AccountType: string
{
    case Customer = "C";
    case Administrator = "A";
}
