<?php

/*Autor(en): */

namespace Vestis\Controller;

use Vestis\Database\Repositories\ProductTypeRepository;

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
        $products = ProductTypeRepository::findBestsellers();
        require_once __DIR__.'/../views/index.php';
    }

}
/*Autor(en): */
