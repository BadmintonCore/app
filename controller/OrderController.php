<?php

namespace Vestis\Controller;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Models\OrderStatus;
use Vestis\Database\Repositories\OrderRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\EmailException;
use Vestis\Exception\LogicException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\EmailService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

/**
 * Controller für Aufträge
 */
class OrderController
{
    /**
     * Listet alle Aufträge eines Nutzers auf
     *
     * @return void
     * @throws LogicException
     */
    public function orders(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        if (AuthService::$currentAccount === null) {
            throw new LogicException("Du hast keinen Account");
        }
        $page = PaginationUtility::getCurrentPage();

        $orders = OrderRepository::findPaginatedForUser(AuthService::$currentAccount, $page, 25);

        require_once __DIR__ . '/../views/shared/orders.php';
    }

    /**
     * Listet die Details eines Auftrages für den Kunden auf.
     *
     * @return void
     * @throws AuthException
     * @throws ValidationException
     */
    public function orderDetails(): void
    {
        AuthService::checkAccess(AccountType::Customer);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer),
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $order = OrderRepository::findById($formData["id"]);

        if ($order === null || AuthService::$currentAccount === null || $order->accountId !== AuthService::$currentAccount->id) {
            throw new AuthException("Du hast keinen Zugriff zu diesem Auftrag.");
        }

        require_once __DIR__ . '/../views/shared/orderView.php';
    }

    /**
     * Storniert einen Auftrag.
     *
     * @return void
     * @throws AuthException
     * @throws LogicException
     * @throws ValidationException
     * @throws EmailException
     */
    public function cancelOrder(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer),
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $order = OrderRepository::findById($formData["id"]);

        if ($order === null || AuthService::$currentAccount === null || $order->accountId !== AuthService::$currentAccount->id) {
            throw new AuthException("Du hast keinen Zugriff zu diesem Auftrag.");
        }

        if (in_array($order->status, [OrderStatus::Canceled, OrderStatus::Denied, OrderStatus::Shipped], true)) {
            throw new LogicException("Der Auftrag kann nicht storniert werden.");
        }
        OrderRepository::updateStatus($order->id, OrderStatus::Canceled);
        EmailService::sendCancelConfirmation($order);

        header('Location: /user-area/orders/view?id=' . $order->id);
    }

}
