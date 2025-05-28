<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ColorRepository;
use Vestis\Service\AuthService;

class AdminColorsController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $colors = ColorRepository::findAll();
        require_once __DIR__.'/../../views/admin/colors/list.php';
    }

}