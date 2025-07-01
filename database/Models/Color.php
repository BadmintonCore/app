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
 * Das Modell für eine Farbe in der Datenbank
 */
class Color
{
    public int $id;

    public string $hex;

    public string $name;

}
