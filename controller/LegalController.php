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
 * Controller für Rechtliches
 */
class LegalController
{
    public function root(): void
    {
        header('Location: /');
    }

    /**
     * Ansicht für die AGBs
     *
     * @return void
     */
    public function gtc(): void
    {
        require_once __DIR__."/../views/legal/gtc.php";
    }

    /**
     * Ansicht für das Impressum
     *
     * @return void
     */
    public function impress(): void
    {
        require_once __DIR__."/../views/legal/impress.php";
    }

    /**
     * Ansicht für den Datenschutz
     *
     * @return void
     */
    public function privacy(): void
    {
        require_once __DIR__."/../views/legal/privacypolicy.php";
    }

    /**
     * Ansicht für die Widerrufserklärung
     *
     * @return void
     */
    public function revocation(): void
    {
        require_once __DIR__."/../views/legal/revocation.php";
    }
}
