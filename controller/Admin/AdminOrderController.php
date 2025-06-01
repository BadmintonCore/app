<?php

namespace Vestis\Controller\Admin;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Models\OrderStatus;
use Vestis\Database\Repositories\OrderRepository;
use Vestis\Exception\LogicException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;
use Vestis\Utility\PaginationUtility;

class AdminOrderController
{

    public function index(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        if (!isset($_GET['status'])) {
            header('Location: /admin/orders?status=' . OrderStatus::PaymentPending->value);
            return;
        }

        $status = OrderStatus::tryFrom($_GET['status']);
        if (null === $status) {
            throw new LogicException("Der Status ist nicht zulässig.");
        }

        $page = PaginationUtility::getCurrentPage();
        $orders = OrderRepository::findPaginatedWithStatus($status, $page, 25);

        require_once __DIR__ . '/../../views/shared/orders.php';
    }

    /**
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
    public function details(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer)
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $order = OrderRepository::findById($formData['id']);
        if (null === $order) {
            throw new LogicException("Der Bestellung wurde nicht gefunden.");
        }

        require_once __DIR__ . '/../../views/shared/orderView.php';
    }

    /**
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
    public function deny(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer)
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $order = OrderRepository::findById($formData['id']);

        if (null === $order) {
            throw new LogicException("Die Bestellung wurde nicht gefunden.");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!in_array($order->status, [OrderStatus::PaymentPending, OrderStatus::InProgress])) {
                throw new LogicException("Der Auftrag kann nicht mehr abgelehnt werden.");
            }

            $validationRules = [
                'reason' => new ValidationRule(ValidationType::String)
            ];
            ValidationService::validateForm($validationRules, "POST");
            $formData = ValidationService::getFormData();

            OrderRepository::updateStatus($order->id, OrderStatus::Denied);
            OrderRepository::setDenialMessage($order->id, $formData['reason']);

            header('Location: /admin/orders/view?id=' . $order->id);
            return;
        }


        require_once __DIR__ . '/../../views/admin/orders/deny.php';
    }

    /**
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
    public function confirmPayment(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer)
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $order = OrderRepository::findById($formData['id']);

        if ($order->status !== OrderStatus::PaymentPending) {
            throw new LogicException("Die Zahlung des Auftrags kann nicht akzeptiert werden.");
        }

        OrderRepository::updateStatus($order->id, OrderStatus::InProgress);

        header('Location: /admin/orders/view?id=' . $order->id);
    }

    /**
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
    public function confirmShipment(): void
    {
        AuthService::checkAccess(AccountType::Administrator);

        $validationRules = [
            'id' => new ValidationRule(ValidationType::Integer)
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $order = OrderRepository::findById($formData['id']);

        if ($order->status !== OrderStatus::InProgress) {
            throw new LogicException("Der Versand des Auftrags kann nicht bestätigt werden.");
        }

        OrderRepository::updateStatus($order->id, OrderStatus::Shipped);

        header('Location: /admin/orders/view?id=' . $order->id);
    }

}