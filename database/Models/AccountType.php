<?php

namespace Vestis\Database\Models;

/**
 * Der Typ, den ein Benutzeraccount haben kann {@see Account::$type}
 */
enum AccountType: string
{
    case Customer = "C";
    case Administrator = "A";
}
