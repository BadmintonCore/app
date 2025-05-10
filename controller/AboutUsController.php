<?php

namespace Vestis\Controller;

class AboutUsController
{
    public function about(): void
    {
        require_once "../views/about-us/about.php";
    }

    public function jobs(): void
    {
        require_once "../views/about-us/jobs.php";
    }

    public function press(): void
    {
        require_once "../views/about-us/press.php";
    }

    public function responsibility(): void
    {
        require_once "../views/about-us/responsibility.php";
    }

}
