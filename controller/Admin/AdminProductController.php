<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;

class AdminProductController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $productTypeId = intval($_GET['id']);

        throw new ValidationException("Hier muss ich noch auf Lasses Arbeit warten");
    }

}