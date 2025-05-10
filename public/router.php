<?php
/** Author: Mathis Burger */

// Uses composer to load all defined namespaces defined in composer.json
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;

require_once "../vendor/autoload.php";

$dbConnection = new \PDO("mysql:host=db;dbname=vestis", "vestis", "vestis");

// We want to use OOP approach of PHP. Therefore, we set PDO to use exceptions instead of errors.
$dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

// Declare database connection as global variable. It can be now found at $_GLOBALS['dbConnection']
global $dbConnection;

try {
    // Sets the current user account as global variable from session cookie
    AuthService::setCurrentUserAccountSessionFromCookie();
} catch (ValidationException $e) {
    echo $e->getMessage();
    die();
}



$requestUri = substr($_SERVER["REQUEST_URI"], 1);
$pathname = explode("?", $requestUri)[0];

if ($pathname === "") {
    require_once "../views/index.php";
    return;
}

// If the requested file exists in pages folder and is a php file, we require it in order to load the contents of the file
if (str_ends_with($pathname, ".php") && file_exists(sprintf("../views/%s", $pathname))) {
    require_once sprintf("../views/%s", $pathname);
} else {
    require_once "../views/404.php";
}

/** Author: Mathis Burger */