<?php
/** Author: Mathis Burger */

// Wird immer aufgerufen, außer es existiert eine Datei im public Ordner (Konfiguration in .htaccess)
require_once __DIR__ ."/../autoload.php";
require_once __DIR__ ."/../Kernel.php";

/** @phpstan-ignore-next-line  */
(new Kernel())->run();

/** Author: Mathis Burger */
