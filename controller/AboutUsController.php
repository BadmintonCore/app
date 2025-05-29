<?php

namespace Vestis\Controller;

/**
 * Controller für die "About us"-Ansichten
 */
class AboutUsController
{
    public function about(): void
    {
        require_once __DIR__."/../views/about-us/about.php";
    }

    public function jobs(): void
    {
        require_once __DIR__."/../views/about-us/jobs.php";
    }

    public function press(): void
    {
        require_once __DIR__."/../views/about-us/press.php";
    }

    public function responsibility(): void
    {
        require_once __DIR__."/../views/about-us/responsibility.php";
    }

}
