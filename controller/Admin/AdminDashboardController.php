<?php

namespace Vestis\Controller\Admin;

class AdminDashboardController
{

    public function index(): void
    {
        require_once __DIR__.'/../../views/admin/dashboard.php';
    }

}