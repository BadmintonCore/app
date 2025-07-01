<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Database\Dto;

/**
 * DTO (Domain Transfer Object) für pagination Ergebnisse
 *
 * @template T of object
 */
class PaginationDto
{
    public int $count;

    /**
     * @var array<int, T>
     */
    public array $results;

    /**
     * @param int $count
     * @param array<int, T> $results
     */
    public function __construct(int $count, array $results)
    {
        $this->count = $count;
        $this->results = $results;
    }
}
