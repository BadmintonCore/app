<?php

use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Utility\PathUtility;

/**
 * Central kernel for handling requests
 */
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
        /** @var array<string, array<int, string>> $routes */
        $routes = require __DIR__.'/routes.php';
        $pathname = PathUtility::getPathname();

        if (strlen($pathname) > 1 && str_ends_with($pathname, "/")) {
            $pathname = substr($pathname, 0, strlen($pathname) - 1);
        }
        if (!array_key_exists($pathname, $routes)) {
            require_once __DIR__.'/views/404.php';
            return;
        }

        [$controllerClass, $method] = $routes[$pathname];
        /** @phpstan-ignore-next-line */
        $controller = new $controllerClass();

        try {

            // Verhindert explizit die Ausgabe des Output Buffers.
            ob_start();

            /** @phpstan-ignore-next-line */
            $controller->$method();
        } catch (Throwable $exception) {

            // Löscht den bisherigen Buffer Inhalt
            ob_end_clean();


            $errorMessage = $exception->getMessage();
            require_once __DIR__.'/views/error.php';
        }

        // Gibt den ganzen Buffer aufeinmal frei und sendet ihn zum Client
        ob_flush();

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
