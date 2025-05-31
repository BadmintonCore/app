<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Utility\PaginationUtility;

class AdminProductController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $productTypeId = intval($_GET['id']);
        $page = PaginationUtility::getCurrentPage();

        $products = ProductRepository::findForTypePaginated($productTypeId, $page, 25);

        if (0 === $productTypeId) {
            throw new ValidationException("Parameter für den Produkt-Typen fehlt.");
        }

        require_once __DIR__ . "/../../views/admin/products/list.php";
    }

}