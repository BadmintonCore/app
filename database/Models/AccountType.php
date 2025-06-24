<?php

//Autor(en): Lasse Hoffmann, Mathis Burger, Lennart Moog

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
//Autor(en): Lasse Hoffmann, Mathis Burger, Lennart Moog
