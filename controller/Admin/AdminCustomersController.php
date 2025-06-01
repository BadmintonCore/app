<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\AccountRepository;
use Vestis\Exception\LogicException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

class AdminCustomersController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $page = PaginationUtility::getCurrentPage();
        $customers = AccountRepository::findCustomersPaginated($page, 25);

        require_once __DIR__ . '/../../views/admin/customers/list.php';
    }

    public function toggleBlock(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer)
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $account = AccountRepository::findById($formData['id']);

        if ($account === null || $account->type === AccountType::Administrator) {
            throw new LogicException("Der Nutzer existiert nicht oder ist kein Kunde.");
        }

        AccountRepository::setBlocked($account->id, !$account->isBlocked);

        header("Location: /admin/customers");
    }

}