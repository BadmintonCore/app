<?php

namespace Vestis\Database\Repositories;

/**
 * Abstraction layer on top of the database. It allows to simplify building native SQL queries and maps the
 * results to the model class that is referenced.
 */
class QueryAbstraction
{

    /**
     * @param string $className The name of the class that should be the fetch result of the SQL query
     * @param string $query The custom SQL query
     * @param array $params All parameters of the SQL query
     * @return array<int, mixed> The result array
     */
    public static function fetchManyAs(string $className, string $query, array $params = []): array
    {
        $statement = QueryAbstraction::prepareAndExecuteStatement($query, $params);
        return $statement->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    /**
     * @param string $className The name of the class that should be the fetch result of the SQL query
     * @param string $query The custom SQL query
     * @param array $params All parameters of the SQL query
     * @return mixed The result as the requested class
     */
    public static function fetchOneAs(string $className, string $query, array $params = []): mixed
    {
        $newQuery = sprintf("%s LIMIT 1", $query);
        $statement = QueryAbstraction::prepareAndExecuteStatement($newQuery, $params);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $statement->fetch(\PDO::FETCH_CLASS) ?? null;
    }

    /**
     * Executes an SQL statement
     *
     * @param string $query The SQL statement that should be executed
     * @param array $params The parameters that are required
     * @return void
     */
    public static function execute(string $query, array $params = []): void
    {
        QueryAbstraction::prepareAndExecuteStatement($query, $params);
    }

    /**
     * Prepares and executes the statement
     *
     * @param string $query The sql statement with params
     * @param array $params The params
     * @return \PDOStatement The executed statement
     */
    private static function prepareAndExecuteStatement(string $query, array $params = []): \PDOStatement
    {
        /** @var ?\PDO $connection */
        $connection = $GLOBALS['dbConnection'];
        if ($connection == null) {
            throw new \RuntimeException("You need to initialize a database connection in order to execute queries.");
        }
        $statement = $connection->prepare($query);
        foreach ($params as $key => $value) {
            if (is_bool($value)) {
                $statement->bindValue($key, $value, \PDO::PARAM_BOOL);
            } else {
                $statement->bindValue($key, $value);
            }
        }
        $statement->execute();
        return $statement;
    }

}