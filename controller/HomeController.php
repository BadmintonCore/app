<?php

/*Autor(en): */

namespace Vestis\Controller;

/**
 * Controller für die Startseite
 */
class HomeController
{
    /**
     * Ansicht für die Startseite
     *
     * @return void
     */
    public function index(): void
    {
        require_once __DIR__.'/../views/index.php';
    }

}
/*Autor(en): */
