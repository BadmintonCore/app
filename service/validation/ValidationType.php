<?php

//Autor(en): Lennart Moog, Lasse Hoffmann

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
//Autor(en): Lennart Moog, Lasse Hoffmann
