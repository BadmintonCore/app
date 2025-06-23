<?php

namespace Vestis\Database\Repositories;

use PDO;
use Vestis\Database\Dto\PaginationDto;
use Vestis\Exception\DatabaseException;

/**
 * Abstraktionsschicht für die Datenbank.
 * Sie vereinfacht die Erstellung nativer SQL-Abfragen und bildet die Ergebnisse auf die referenzierte Modellklasse ab.
 */
class QueryAbstraction
{
    /**
     * Holt mehrere Einträge basierend auf einer SQL-Abfrage
     *
     * @param class-string<T>|null $className Der Name der Klasse, in die das Ergebnis der SQL-Abfrage gemappt werden soll
     * @param string $query Die benutzerdefinierte SQL-Abfrage
     * @param array<string, int|bool|string|null|array<int, int|bool|string|null>> $params Alle Parameter der SQL-Abfrage
     * @return ($className is null ? array<int, array<string, int|bool|string|null|array<int, int|bool|string|null>>> : array<T>) Das Ergebnisarray
     * @throws DatabaseException bei Datenbank- oder Reflektionsfehlern
     *
     * @template T of object
     */
    public static function fetchManyAs(?string $className, string $query, array $params = []): array
    {
        $statement = QueryAbstraction::prepareAndExecuteStatement($query, $params);
        $results =  $statement->fetchAll(\PDO::FETCH_ASSOC);
        if ($className === null) {
            return $results;
        }
        return array_map(fn (array $item) => self::convertAssocToClass($className, $item), $results);
    }

    /**
     * Paginierung einer SQL-Abfrage durch dynamische Nutzung von LIMIT und OFFSET. Das Ergebnis wird dann als DTO zurückgegeben.
     *
     * @param class-string<T> $className Der Name der Klasse, in die das Ergebnis der SQL-Abfrage gemappt werden soll
     * @param string $query Die benutzerdefinierte SQL-Abfrage
     * @param int $page Die Seite, die über die Paginierung ausgewählt werden soll
     * @param int $perPage Die Anzahl der Einträge pro Seite
     * @param array<string, int|bool|string|null|array<int, int|bool|string|null>> $params Alle Parameter der SQL-Abfrage
     * @return PaginationDto<T> Das paginierte Ergebnis
     *
     * @template T of object
     */
    public static function fetchManyAsPaginated(string $className, string $query, int $page, int $perPage, array $params = []): PaginationDto
    {
        $fromIndex = strpos($query, ' FROM');
        if ($fromIndex === false) {
            throw new DatabaseException("Deine SQL-Abfrage ist ungültig", 0);
        }
        $countQuery = sprintf("SELECT COUNT(*) AS count %s", substr($query, $fromIndex));
        $countResult = self::fetchOneAs(null, $countQuery, $params);

        if ($countResult === null) {
            throw new DatabaseException("Anzahl für Paginierungsabfrage kann nicht ermittelt werden", 0);
        }

        /** @var int $count */
        ['count' => $count] = $countResult;

        $resultsQuery = sprintf('%s LIMIT %s OFFSET %s', $query, $perPage, ($page - 1) * $perPage);
        $results = QueryAbstraction::fetchManyAs($className, $resultsQuery, $params);

        return new PaginationDto($count, $results);
    }

    /**
     * Holt genau einen Eintrag basierend auf einer SQL-Abfrage
     *
     * @param class-string<T>|null $className Der Name der Klasse, in die das Ergebnis der SQL-Abfrage gemappt werden soll
     * @param string $query Die benutzerdefinierte SQL-Abfrage
     * @param array<string, int|bool|string|null|array<int, int|bool|string|null>> $params Alle Parameter der SQL-Abfrage
     * @return ($className is null ?  array<string, int|bool|string|null|array<int, int|bool|string|null>>|null : T|null) Das Ergebnis als angegebene Klasse
     * @throws DatabaseException bei Datenbank- oder Reflektionsfehlern
     *
     * @template T of object
     */
    public static function fetchOneAs(?string $className, string $query, array $params = []): mixed
    {
        $newQuery = sprintf("%s LIMIT 1", $query);
        $statement = QueryAbstraction::prepareAndExecuteStatement($newQuery, $params);
        /** @var array<string, int|bool|string|null>|null|false $assoc */
        $assoc =  $statement->fetch(\PDO::FETCH_ASSOC) ?? null;

        // Wenn kein Klassenname gegeben, soll einfach das assoziative Array zurück gegeben werden
        if ($className === null && $assoc !== false) {
            return $assoc;
        }
        if (null !== $assoc && false !== $assoc && $className !== null) {
            return self::convertAssocToClass($className, $assoc);
        }
        return null;
    }

    /**
     * Führt ein SQL-Statement aus
     *
     * @param string $query Das SQL-Statement, das ausgeführt werden soll
     * @param array<string, float|int|bool|string|null|array<int, int|bool|string|null|float>> $params Die benötigten Parameter
     * @return void
     * @throws DatabaseException bei Datenbankfehlern
     */
    public static function execute(string $query, array $params = []): void
    {
        QueryAbstraction::prepareAndExecuteStatement($query, $params);
    }

    /**
     * Führt ein SQL-Statement aus und gibt die Antwort zurück.
     *
     * @param class-string<T> $className Der Name der Klasse, in die das Ergebnis gemappt werden soll
     * @param string $query Das SQL-Statement, das ausgeführt werden soll
     * @param array<string, int|bool|string|null|float|array<int, int|bool|string|null|float>> $params Die benötigten Parameter
     * @return T|null Das Ergebnis als angegebene Klasse
     * @throws DatabaseException bei Datenbankfehlern
     *
     * @template T of object
     */
    public static function executeReturning(string $className, string $query, array $params = []): mixed
    {
        QueryAbstraction::prepareAndExecuteStatement($query, $params);

        $assoc =  self::mariaDB100428ReturningWrapper($query, self::normalizeParams($query, $params));
        return self::convertAssocToClass($className, $assoc);
    }

    /**
     * Bereitet das Statement vor und führt es aus
     *
     * @param string $query Das SQL-Statement mit Parametern
     * @param array<string, float|int|bool|string|null|array<int, int|bool|string|null|float>> $params Die Parameter
     * @return \PDOStatement Das ausgeführte Statement
     * @throws DatabaseException bei Datenbankfehlern
     */
    private static function prepareAndExecuteStatement(string $query, array $params = []): \PDOStatement
    {
        /** @var ?\PDO $connection */
        $connection = $GLOBALS['dbConnection'];
        if ($connection === null) {
            throw new \RuntimeException("Du musst eine Datenbankverbindung initialisieren, um Abfragen auszuführen.");
        }

        $normalizedParams = self::normalizeParams($query, $params);
        $statement = $connection->prepare($query);
        self::bindParams($statement, $normalizedParams);

        try {
            $statement->execute();
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), is_int($e->getCode()) ? $e->getCode() : -1, $e);
        }
        return $statement;
    }

    /**
     * Konvertiert ein assoziatives Array in eine Klasseninstanz mittels Reflection
     * HINWEIS: Dies ist notwendig, da PDO keine Daten in Enums schreiben kann
     *
     * @param class-string<T> $className Der Name der Zielklasse
     * @param array<string, int|bool|string|null> $assoc Das assoziative Array
     * @return T Der zurückgegebene Wert
     * @throws DatabaseException Fehler, die bei ungültigen Enum-Werten auftreten können
     *
     * @template T of object
     */
    private static function convertAssocToClass(string $className, array $assoc): mixed
    {
        // Prüft, ob die Zielklasse existiert
        if (!class_exists($className)) {
            throw new DatabaseException("Klasse $className existiert nicht", 404, null);
        }

        // Erstellt ein ReflectionClass-Objekt und eine Instanz der gewünschten Klasse
        // Mehr Informationen zu Reflection: https://www.php.net/manual/de/intro.reflection.php
        // Betrachtung eines Objekts auf Metaebene zur Laufzeit
        $reflectionClass = new \ReflectionClass($className); // ReflectionClass aus der Klasse erstellen
        try {
            $instance = $reflectionClass->newInstance(); // Instanz der gegebenen Klasse erstellen
        } catch (\ReflectionException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }

        // Für eine Datenbank die Key Value Paare (bspw. Account: username => test, ...)
        foreach ($assoc as $key => $value) {

            // Prüft, ob die durch Reflection geladene Klasse die Eigenschaft mit dem Namen des aktuellen Array-Schlüssels hat
            if ($reflectionClass->hasProperty($key)) {

                $property = $reflectionClass->getProperty($key);

                // Holt den Datentyp der Eigenschaft
                $type = $property->getType();

                // Prüft, ob der Typ ein Enum ist. Enums benötigen eine spezielle Behandlung
                /** @var int|string|null $value */
                if ($value !== null && $type instanceof \ReflectionNamedType && is_a($type->getName(), \BackedEnum::class, true)) {
                    try {
                        // Versucht, eine Instanz des Enums aus dem primitiven Datentyp zu erzeugen
                        $value = $type->getName()::from($value);
                    } catch (\RuntimeException $e) {
                        throw new DatabaseException(sprintf("Wert kann nicht als gültiger Wert des %s-Typs validiert werden", $type->getName()), $e->getCode(), $e);
                    }
                }

                if ($type instanceof \ReflectionNamedType && $type->getName() === \DateTime::class && is_string($value)) {
                    $value =  \DateTime::createFromFormat('Y-m-d H:i:s', $value);
                }

                if (is_string($value)) {
                    /**
                     * Entfernt unnötige Whitespaces, die ansonsten bei Textareas blöd angezeigt werden.
                     * ^[] matcht am Anfang eines Strings
                     * []$ matcht am Ende eines Strings
                     * /u heißt, der String soll als UTF-8 behandelt werden
                     *
                     * [\s\p{Z}\x00-\x1F\x7F]:
                     *      \s: Normale Whitespaces
                     *      \p{Z}: Unicode-Whitespaces
                     *      \x00-\x1F: Unsichtbare ASCII-Zeichen
                     */
                    $value = preg_replace('/^[\s\p{Z}\x00-\x1F]+|[\s\p{Z}\x00-\x1F\x7F]+$/u', '', $value);
                }

                // Setzt die Eigenschaft in der tatsächlichen Klasseninstanz
                $property->setValue($instance, $value);
            }
        }
        return $instance;
    }

    /**
     * Wrapper für das native "RETURNING *", da dies in MariaDB 10.4.28 nicht vorhanden ist, die
     * Entwicklung der Anwendung aber auf MariaDB 11 stattfand.
     *
     * @param string $query
     * @param array<string, float|int|bool|string|null|array<int, int|bool|string|null|float>>  $params
     * @return array<string, int|bool|string|null>
     */
    private static function mariaDB100428ReturningWrapper(string $query, array $params): array
    {
        /** @phpstan-ignore-next-line strtok immer erfolgreich */
        $queryType = strtoupper(strtok(trim($query), " "));

        /** @var \PDO $pdo */
        $pdo = $GLOBALS['dbConnection'];

        $lastId = $pdo->lastInsertId();

        if ($queryType === 'INSERT') {
            // Extract table name
            if (false === preg_match('/INSERT\s+INTO\s+`?(\w+)`?/i', $query, $matches)) {
                throw new DatabaseException("Failed to parse table name from INSERT.", 0, null);
            }
            $table = $matches[1];

            // Get auto-increment column name
            $stmt = $pdo->prepare("
        SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = ?
          AND EXTRA = 'auto_increment'
        LIMIT 1
    ");
            $stmt->execute([$table]);
            $pk = $stmt->fetchColumn();

            if (false === $pk || null === $pk) {
                throw new DatabaseException("No AUTO_INCREMENT column found for table `$table`.", 0, null);
            }


            // Fetch the inserted row
            $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE `$pk` = ?");
            $stmt->execute([$lastId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        } elseif ($queryType === 'UPDATE') {
            // Extract table name and WHERE clause
            if (false === preg_match('/UPDATE\s+`?(\w+)`?\s+SET\s+.+?\s+WHERE\s+(.+)/is', $query, $matches)) {
                throw new DatabaseException("Failed to parse table name or WHERE clause from UPDATE.", 0, null);
            }
            $table = $matches[1];
            $where = trim($matches[2]);
            if (str_ends_with($where, ';')) {
                $where = substr($where, 0, -1);  // remove trailing semicolon
            }

            // Fetch updated rows using the same WHERE clause
            $selectQuery = "SELECT * FROM `$table` WHERE $where";

            $stmt = $pdo->prepare($selectQuery);

            $filteredParams = [];

            foreach ($params as $key => $value) {
                if (str_contains($selectQuery, ':' . $key)) {
                    $filteredParams[$key] = $value;
                }
            }

            self::bindParams($stmt, $filteredParams);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } else {
            throw new DatabaseException("Only INSERT and UPDATE statements are supported.", 0, null);
        }
    }

    /**
     * Normalisiert die Parameter, damit sie in der Query genutzt werden können
     *
     * @param array<string, float|int|bool|string|null|array<int, int|bool|string|null|float>> $params
     * @return array<string, float|int|bool|string|null|array<int, int|bool|string|null|float>>
     */
    private static function normalizeParams(string &$query, array $params): array
    {
        $normalizedParams = [];

        foreach ($params as $key => $value) {
            // Wert ist ein Array
            if (is_array($value)) {
                $newParams = [];

                // Ist das Array leer, ist der Parameter-Wert null
                if (count($value) === 0) {
                    $normalizedParams[$key] = null;
                } else {

                    // Ersetzt den einen Parameter durch beliebig viele Parameter, um das Array in der SQL-Abfrage darzustellen

                    foreach ($value as $i => $subValue) {
                        $newParams["{$key}_$i"] = $subValue;
                    }
                    $newQueryParamArray = array_map(fn (string $param) => sprintf(":%s", $param), array_keys($newParams));
                    $query = str_replace(':' . $key, sprintf('(%s)', implode(', ', $newQueryParamArray)), $query);
                    $normalizedParams = array_merge($normalizedParams, $newParams);
                }

            } else {
                // Ist es kein Array, kann der Parameter normal verwendet werden
                $normalizedParams[$key] = $value;
            }
        }

        return $normalizedParams;
    }

    /**
     * Bindet alle Parameter an das Statement
     *
     * @param \PDOStatement $stmt
     * @param array<string, float|int|bool|string|null|array<int, int|bool|string|null|float>> $params
     * @return void
     */
    private static function bindParams(\PDOStatement &$stmt, array $params): void
    {
        foreach ($params as $key => $value) {
            if (is_bool($value)) {
                $stmt->bindValue($key, $value, \PDO::PARAM_BOOL);
            } else {
                $stmt->bindValue($key, $value);
            }
        }

    }
}
