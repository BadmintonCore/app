<?php

namespace Vestis\Controller;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Models\Order;
use Vestis\Database\Models\OrderStatus;
use Vestis\Database\Repositories\OrderRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\LogicException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\EmailService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

class OrderController
{

    public function orders(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $page = PaginationUtility::getCurrentPage();

        $orders = OrderRepository::findPaginatedForUser(AuthService::$currentAccount, $page, 25);

        require_once __DIR__ . '/../views/shared/orders.php';
    }

    /**
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

        if ($order === null || $order->accountId !== AuthService::$currentAccount->id) {
            throw new AuthException("Du hast keinen Zugriff zu diesem Auftrag.");
        }

        require_once __DIR__ . '/../views/shared/orderView.php';
    }

    /**
     * @return void
     * @throws AuthException
     * @throws LogicException
     * @throws ValidationException
     * @throws \Vestis\Exception\EmailException
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

        if ($order === null || $order->accountId !== AuthService::$currentAccount->id) {
            throw new AuthException("Du hast keinen Zugriff zu diesem Auftrag.");
        }

        if (in_array($order->status, [OrderStatus::Canceled, OrderStatus::Denied, OrderStatus::Shipped])) {
            throw new LogicException("Der Auftrag kann nicht storniert werden.");
        }
        OrderRepository::updateStatus($order->id, OrderStatus::Canceled);
        EmailService::sendCancelConfirmation($order);

        header('Location: /user-area/orders/view?id=' . $order->id);
    }

}