<?php

namespace Vestis\Exception;

use Throwable;

/**
 * Exception used in the context of database queries
 */
class DatabaseException extends \PDOException
{
    /**
     * @var DatabaseExceptionReason|null The reason that triggered the exception
     */
    private ?DatabaseExceptionReason $reason = null;

    /**
     * @var string|null The name of the column which caused the error
     */
    private ?string $columnName = null;

    public function __construct(string $message, int $code, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        // SQLSTATE[23000] is the error code for a constraint violation. By searching for "duplicate entry" we ensure it is a unique constraint
        if ($code === 23000 && str_contains(strtolower($message), "duplicate entry")) {
            $this->reason = DatabaseExceptionReason::ViolatedUniqueConstraint;
            // use 9 here, because needle is 8 chars long and we need strpos + needle-length + 1 as offset
            $this->columnName = rtrim(substr($message, strrpos($message, "for key ") + 9), "'");
        }
    }

    public function getReason(): ?DatabaseExceptionReason
    {
        return $this->reason;
    }

    public function getColumnName(): ?string
    {
        return $this->columnName;
    }
}