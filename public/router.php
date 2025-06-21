<?php

/** Author: Mathis Burger */

// Wird immer aufgerufen, außer es existiert eine Datei im public Ordner (Konfiguration in .htaccess)
require_once "../autoload.php";
require_once "../Kernel.php";

/** @phpstan-ignore-next-line  */
new Kernel()->run();

/** Author: Mathis Burger */
