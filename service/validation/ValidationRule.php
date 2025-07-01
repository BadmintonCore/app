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
 * Definiert die Struktur einer Regel, die festlegt, wie ein bestimmtes Feld überprüft werden soll
 */
class ValidationRule
{
    public ValidationType $type;

    public bool $nullable;

    public function __construct(ValidationType $type, bool $nullable = false)
    {
        $this->type = $type;
        $this->nullable = $nullable;
    }

}
