<?php

namespace Vestis\Service\validation;

/**
 * All different possible data / synthetic types that can be used for validation
 */
enum ValidationType
{
    case String;
    case Integer;
    case Email;
    case Boolean;
}
