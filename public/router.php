<?php
/** Author: Mathis Burger */

// Uses composer to load all defined namespaces defined in composer.json
require_once "../vendor/autoload.php";

$dbConnection = new \PDO("mysql:host=db;dbname=vestis", "vestis", "vestis");

// We want to use OOP approach of PHP. Therefore, we set PDO to use exceptions instead of errors.
$dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

// Declare database connection as global variable. It can be now found at $_GLOBALS['dbConnection']
global $dbConnection;



$requestUri = substr($_SERVER["REQUEST_URI"], 1);
$pathname = explode("?", $requestUri)[0];

if ($pathname === "") {
    require_once "../pages/index.php";
}

// If the requested file exists in pages folder and is a php file, we require it in order to load the contents of the file
if (str_ends_with($pathname, ".php") && file_exists(sprintf("../pages/%s", $pathname))) {
    require_once sprintf("../pages/%s", $pathname);
} else {
    require_once "../pages/404.php";
}

/** Author: Mathis Burger */