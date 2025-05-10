<?php

namespace Vestis\Controller;

use Vestis\Database\Models\AccountType;
use Vestis\Service\AuthService;

class UserAreaController
{

    public function shoppingCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        require_once '../views/user-area/shoppingCart.php';
    }

    public function user(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        require_once '../views/user-area/user.php';
    }

}