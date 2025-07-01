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

/**
 * Controller für die "About us"-Ansichten
 */
class AboutUsController
{
    public function root(): void
    {
        header('Location: /');
    }

    /**
     * Ansicht für die Über-Uns-Seite
     *
     * @return void
     */
    public function about(): void
    {
        require_once __DIR__."/../views/about-us/about.php";
    }

    /**
     * Ansicht für die Jobs-Seite
     *
     * @return void
     */
    public function jobs(): void
    {
        require_once __DIR__."/../views/about-us/jobs.php";
    }

    /**
     * Ansicht für die Presse-Seite
     *
     * @return void
     */
    public function press(): void
    {
        require_once __DIR__."/../views/about-us/press.php";
    }

    /**
     * Ansicht für die Verantwortlichkeit-Seite
     *
     * @return void
     */
    public function responsibility(): void
    {
        require_once __DIR__."/../views/about-us/responsibility.php";
    }

}
