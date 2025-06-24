<?php

//Autor(en): Lennart Moog

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
//Autor(en): Lennart Moog
