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
        $this->serveStaticFile();
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
        try {
            $dbConnection = new \PDO("mysql:host=127.0.0.1;dbname=vestis", "lasse2", "webtech");
        } catch (Throwable $exception) {
            echo $exception->getMessage();
        }

        // We want to use OOP approach of PHP. Therefore, we set PDO to use exceptions instead of errors.
        $dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Declare database connection as global variable. It can be now found at $_GLOBALS['dbConnection']
        $GLOBALS['dbConnection'] = $dbConnection;
    }

    private function serveStaticFile(): void
    {
        $requestedPath = $_SERVER['REQUEST_URI'];

        $requestedPath = parse_url($requestedPath, PHP_URL_PATH);

        $filePath = __DIR__ . '/public/' . $requestedPath;  // Adjust if router.php is in public/ or above

        $publicDir = realpath(__DIR__);
        $realPath = realpath($filePath);

        if ($realPath !== false && str_starts_with($realPath, $publicDir) && is_file($realPath)) {
            // Serve the file with correct headers

            // Get mime type (fallback to octet-stream)
            $mimeType = mime_content_type($realPath) ?: 'application/octet-stream';

            if (str_ends_with($realPath, '.css')) {
                $mimeType = 'text/css';
            }

            header('Content-Type: ' . $mimeType);
            header('Content-Length: ' . filesize($realPath));
            readfile($realPath);
            die();
        }
    }


}
