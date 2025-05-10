<?php

use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;

class Kernel
{
    public function run(): void
    {
        $this->initializeDatabaseConnection();
        $this->initializeSession();
        $this->handleRoute();
    }

    private function handleRoute(): void
    {
        $routes = require 'routes.php';
        $requestUri = $_SERVER['REQUEST_URI'];
        $pathname = explode("?", $requestUri)[0];
        if (!array_key_exists($pathname, $routes)) {
            require_once 'views/404.php';
            return;
        }

        [$controllerClass, $method] = $routes[$pathname];
        $controller = new $controllerClass();
        $controller->$method();

    }

    private function initializeSession(): void
    {
        try {
            // Sets the current user account as global variable from session cookie
            AuthService::setCurrentUserAccountSessionFromCookie();
        } catch (ValidationException $e) {
            echo $e->getMessage();
            die();
        }
    }


    private function initializeDatabaseConnection(): void
    {
        $dbConnection = new \PDO("mysql:host=db;dbname=vestis", "vestis", "vestis");

        // We want to use OOP approach of PHP. Therefore, we set PDO to use exceptions instead of errors.
        $dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Declare database connection as global variable. It can be now found at $_GLOBALS['dbConnection']
        $GLOBALS['dbConnection'] = $dbConnection;
    }


}
