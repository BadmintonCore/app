<?php

namespace Vestis\Controller;

use Vestis\Database\Models\AccountType;
use Vestis\Service\AuthService;

class UserAreaController
{
    public function shoppingCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        require_once __DIR__.'/../views/user-area/shoppingCart.php';
    }

    public function user(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        require_once __DIR__.'/../views/user-area/user.php';
    }

    public function wishlist(): void
    {
        require_once __DIR__.'/../views/user-area/wishlist.php';
    }

}
