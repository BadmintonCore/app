<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\AccountRepository;
use Vestis\Exception\LogicException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

/**
 * Controller für Kunden im Admin-Panel
 */
class AdminCustomersController
{

    /**
     * Paginierte Listenansicht der Kunden
     *
     * @return void
     */
    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $page = PaginationUtility::getCurrentPage();
        $customers = AccountRepository::findCustomersPaginated($page, 25);

        require_once __DIR__ . '/../../views/admin/customers/list.php';
    }

    /**
     * Blockiert / Entblockiert einen Nutzer (Verarbeitet die HTTP Request)
     *
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
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