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
 * Das Model für ein Feedback in der Datenbank
 */
class Feedback
{
    public int $id;

    public string $name;

    public string $evaluation;

    public string $email;

    public string $message;

    public string $createdAt;
}
