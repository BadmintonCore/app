<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Service\validation;

/**
 * Alle möglichen (Daten-)Typen, die für die Validierung verwendet werden können
 */
enum ValidationType
{
    case String;
    case Integer;
    case IntegerArray;
    case Float;
    case Email;
    case Boolean;
    case Json;
    case ImageFile;
    case Text;
}
