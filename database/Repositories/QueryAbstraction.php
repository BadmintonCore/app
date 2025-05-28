<?php

namespace Vestis\Database\Repositories;

use Vestis\Exception\DatabaseException;

/**
 * Abstraction layer on top of the database. It allows to simplify building native SQL queries and maps the
 * results to the model class that is referenced.
 */
class QueryAbstraction
{
    /**
     * @param class-string<T> $className The name of the class that should be the fetch result of the SQL query
     * @param string $query The custom SQL query
     * @param array<string, int|bool|string|null|array<int, int|bool|string|null>> $params All parameters of the SQL query
     * @return array<T> The result array
     * @throws DatabaseException on database or reflection error
     *
     * @template T of object
     */
    public static function fetchManyAs(string $className, string $query, array $params = []): array
    {
        $statement = QueryAbstraction::prepareAndExecuteStatement($query, $params);
        $results =  $statement->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(fn (array $item) => self::convertAssocToClass($className, $item), $results);
    }

    /**
     * @param class-string<T>|null $className The name of the class that should be the fetch result of the SQL query
     * @param string $query The custom SQL query
     * @param array<string, int|bool|string|null|array<int, int|bool|string|null>> $params All parameters of the SQL query
     * @return ($className is null ?  array<string, int|bool|string|null|array<int, int|bool|string|null>>|null : T|null) The result as the requested class
     * @throws DatabaseException on database or reflection error
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
     * Executes an SQL statement
     *
     * @param string $query The SQL statement that should be executed
     * @param array<string, int|bool|string|null|array<int, int|bool|string|null>> $params The parameters that are required
     * @return void
     * @throws DatabaseException on database error
     */
    public static function execute(string $query, array $params = []): void
    {
        QueryAbstraction::prepareAndExecuteStatement($query, $params);
    }

    /**
     * Executes an SQL statement and returns the response.
     *
     * @param class-string<T> $className The name of the class that should be the fetch result of the SQL query
     * @param string $query The SQL statement that should be executed
     * @param array<string, int|bool|string|null|array<int, int|bool|string|null>> $params The parameters that are required
     * @return T|null The result as the requested class
     * @throws DatabaseException on database error
     *
     * @template T of object
     */
    public static function executeReturning(string $className, string $query, array $params = []): mixed
    {
        $newQuery = sprintf("%s RETURNING *", $query);
        $statement = QueryAbstraction::prepareAndExecuteStatement($newQuery, $params);
        /** @var array<string, int|bool|string|null>|null|false $assoc */
        $assoc =  $statement->fetch(\PDO::FETCH_ASSOC) ?? null;
        if (null !== $assoc && false !== $assoc) {
            return self::convertAssocToClass($className, $assoc);
        }
        return null;
    }

    /**
     * Prepares and executes the statement
     *
     * @param string $query The sql statement with params
     * @param array<string, int|bool|string|null|array<int, int|bool|string|null>> $params The params
     * @return \PDOStatement The executed statement
     * @throws DatabaseException On database error
     */
    private static function prepareAndExecuteStatement(string $query, array $params = []): \PDOStatement
    {
        /** @var ?\PDO $connection */
        $connection = $GLOBALS['dbConnection'];
        if ($connection === null) {
            throw new \RuntimeException("You need to initialize a database connection in order to execute queries.");
        }

        $normalizedParams = [];

        foreach ($params as $key => $value) {
            // Wert ist ein Array
            if (is_array($value)) {
                $newParams = [];

                // Ist das Array leer, ist der Parameter-Wert null
                if (count($value) === 0) {
                    $normalizedParams[$key] = null;
                } else {

                    // Ersetzt den einen Parameter durch beliebig viele Parameter, um das Array in der SQL query darzustellen

                    foreach ($value as $i => $subValue) {
                        $newParams["{$key}_$i"] = $subValue;
                    }
                    $newQueryParamArray = array_map(fn (string $param) => sprintf(":%s", $param), array_keys($newParams));
                    $query = str_replace(':' . $key, sprintf('(%s)', implode(', ', $newQueryParamArray)), $query);
                    $normalizedParams = array_merge($normalizedParams, $newParams);
                }

            } else {
                // Ist es kein Array, kann der Paramerer normal verwendet werden
                $normalizedParams[$key] = $value;
            }
        }
        $statement = $connection->prepare($query);
        foreach ($normalizedParams as $key => $value) {
            if (is_bool($value)) {
                $statement->bindValue($key, $value, \PDO::PARAM_BOOL);
            } else {
                $statement->bindValue($key, $value);
            }
        }
        try {
            $statement->execute();
        } catch (\PDOException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }
        return $statement;
    }


    /**
     * Converts an associative array to a class instance by using reflection
     * NOTE: We only need to do this, because PDO does not support writing data into enums
     *
     * @param class-string<T> $className The name of the target class
     * @param array<string, int|bool|string|null> $assoc The associative array
     * @return T The returned value
     * @throws DatabaseException Errors that might occur on invalid enum values
     *
     * @template T of object
     */
    private static function convertAssocToClass(string $className, array $assoc): mixed
    {
        // Checks if the target class even exists
        if (!class_exists($className)) {
            throw new DatabaseException("Class $className does not exist", 404, null);
        }

        // creates a reflection class object and actual instance of the desired class
        // More info about reflection: https://www.php.net/manual/en/intro.reflection.php
        $reflectionClass = new \ReflectionClass($className);
        try {
            $instance = $reflectionClass->newInstance();
        } catch (\ReflectionException $e) {
            throw new DatabaseException($e->getMessage(), $e->getCode(), $e);
        }

        foreach ($assoc as $key => $value) {

            // Checks if the class that is loaded by reflection has the key of the current value in associative array
            if ($reflectionClass->hasProperty($key)) {

                $property = $reflectionClass->getProperty($key);

                // Gets the data type of the property
                $type = $property->getType();

                // Checks whether the data type is an enum. Enums need some extra handling
                /** @var int|string|null $value */
                if ($value !== null && $type instanceof \ReflectionNamedType && is_a($type->getName(), \BackedEnum::class, true)) {
                    try {
                        // Try to instance the enum instance from the primitive data value
                        $value = $type->getName()::from($value);
                    } catch (\RuntimeException $e) {
                        throw new DatabaseException(sprintf("Value cannot be validated as proper value associated with %s type", $type->getName()), $e->getCode(), $e);
                    }
                }

                // Set the property in the actual instance class
                $property->setValue($instance, $value);
            }
        }
        return $instance;
    }
}
