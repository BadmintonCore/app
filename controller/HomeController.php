<?php

namespace Vestis\Controller;

class HomeController
{
    public function index(): void
    {
        require_once __DIR__.'/../views/index.php';
    }

}
