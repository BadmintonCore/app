<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Exception;

/**
 * Ausnahme, die im Zusammenhang mit Datenbankabfragen verwendet wird
 */
class DatabaseException extends \PDOException
{
    /**
     * @var DatabaseExceptionReason|null Der Grund, der die Ausnahme ausgelöst hat
     */
    private ?DatabaseExceptionReason $reason = null;

    /**
     * @var string|null Der Name der Spalte, die den Fehler verursacht hat
     */
    private ?string $columnName = null;

    public function __construct(string $message, int $code, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        // SQLSTATE[23000] ist der Fehlercode für einen Constraint-Verstoß. Durch die Suche nach "duplicate entry" stellen wir sicher, dass es sich um einen Unique-Constraint handelt
        if ($code === 23000 && str_contains(strtolower($message), "duplicate entry")) {
            $this->reason = DatabaseExceptionReason::ViolatedUniqueConstraint;
            // Verwende hier 9, da das Suchwort 8 Zeichen lang ist und wir strpos + Länge des Suchworts + 1 als Offset benötigen
            $pos = strrpos($message, "for key ");
            if ($pos !== false) {
                $this->columnName = rtrim(substr($message, $pos + 9), "'");
            }
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
