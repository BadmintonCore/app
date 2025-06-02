<?php

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
}
