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

        // Wenn pathname größer als 1 und am Ende ein "/"
        if (strlen($pathname) > 1 && str_ends_with($pathname, "/")) {
            $pathname = substr($pathname, 0, strlen($pathname) - 1);
        }

        // Wenn das in routes.php nicht definiert ist
        if (!array_key_exists($pathname, $routes)) {
            require_once __DIR__.'/views/404.php';
            return;
        }

        [$controllerClass, $method] = $routes[$pathname];
        /** @phpstan-ignore-next-line */
        // Instanziiert jeweils dynamisch die zugehörige Klasse zu dem gesuchten Controller
        $controller = new $controllerClass();

        try {

            // Verhindert explizit die Ausgabe des Output Buffers
            ob_start();

            /** @phpstan-ignore-next-line */
            $controller->$method();
        } catch (Throwable $exception) {

            // Löscht den bisherigen Buffer Inhalt
            ob_end_clean();


            $errorMessage = $exception->getMessage();
            $acceptHeader = $_SERVER['HTTP_ACCEPT'] ?? null;
            if (str_contains($acceptHeader, 'application/json')) {
                header('Content-type: application/json');
                echo json_encode(['errorMessage' => $errorMessage]);
            } else {
                require_once __DIR__.'/views/error.php';
            }
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
            // Ab "die()" wird kein php-Code mehr ausgeführt. Es wird nur das ausgegeben, was bereits im Buffer ist
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
