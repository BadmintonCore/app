<?php

namespace Vestis\Exception;

enum DatabaseExceptionReason
{
    case ViolatedUniqueConstraint;
}
