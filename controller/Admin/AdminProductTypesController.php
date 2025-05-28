<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ProductTypeRepository;
use Vestis\Service\AuthService;
use Vestis\Utility\PaginationUtility;

class AdminProductTypesController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);
        $page = PaginationUtility::getCurrentPage();

        $productTypes = ProductTypeRepository::findPaginated($page);
        require_once __DIR__.'/../../views/admin/productTypes/list.php';
    }

}