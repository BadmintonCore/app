<?php

//Autor(en): Mathis Burger

namespace Vestis\Controller;

/**
 * Controller für Rechtliches
 */
class LegalController
{
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
//Autor(en): Mathis Burger
