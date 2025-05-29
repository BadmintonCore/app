<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Service\AuthService;

class AdminDashboardController
{
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        require_once __DIR__.'/../../views/admin/dashboard.php';
    }

}
