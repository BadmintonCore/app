<?php

//Autor(en): Lennart Moog, Lasse Hoffmann

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
//Autor(en): Lennart Moog, Lasse Hoffmann
