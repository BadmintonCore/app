<?php

namespace Vestis\Controller;

class HomeController
{
    public function index(): void
    {
        require_once '../views/index.php';
    }

}
