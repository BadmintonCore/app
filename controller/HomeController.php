<?php

namespace Vestis\Controller;

/**
 * Controller für die Startseite
 */
class HomeController
{
    public function index(): void
    {
        require_once __DIR__.'/../views/index.php';
    }

}
