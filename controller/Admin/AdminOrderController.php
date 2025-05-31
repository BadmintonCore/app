<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\OrderRepository;
use Vestis\Service\AuthService;
use Vestis\Utility\PaginationUtility;

class AdminOrderController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $page = PaginationUtility::getCurrentPage();
        $orders = OrderRepository::findPaginated($page, 25);

        require_once __DIR__ . '/../../views/admin/orders/list.php';
    }

}