<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

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
