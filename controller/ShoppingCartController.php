<?php

namespace Vestis\Controller;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Models\ShoppingCart;
use Vestis\Database\Repositories\OrderRepository;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Database\Repositories\ShoppingCartRepository;
use Vestis\Exception\EmailException;
use Vestis\Exception\LogicException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\EmailService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class ShoppingCartController
{

    /**
     * LIstet alle Warenkörbe auf.
     *
     * @return void
     */
    public function shoppingCarts(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $ownedShoppingCarts = ShoppingCartRepository::findUserShoppingCarts(AuthService::$currentAccount);
        require_once __DIR__ . "/../views/user-area/shoppingCartList.php";
    }

    /**
     * Listet den Warenkorb auf.
     *
     * @throws ValidationException
     */
    public function getShoppingCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);

        $validationRules = [
            'accId' => new ValidationRule(ValidationType::Integer, true),
            'cartNumber' => new ValidationRule(ValidationType::Integer, true)
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $account = AuthService::$currentAccount;

        $shoppingCart = ShoppingCartRepository::findShoppingCart($formData["accId"] ?? $account->id, $formData["cartNumber"] ?? ShoppingCart::DEFAULT_CART_NUMBER);

        if ($shoppingCart === null) {
            throw new ValidationException("Der Warenkorb existiert nicht");
        }

        if (false === ShoppingCartRepository::hasAccessTo($account, $shoppingCart)) {
            throw new ValidationException("Sie haben keinen Zugriff zu diesem Warenkorb");
        }

        $groupedProducts = ShoppingCartRepository::getAllProducts($shoppingCart);

        require_once __DIR__ . '/../views/user-area/shoppingCart.php';

    }

    /**
     * Erstellt einen neuen Warenkorb
     *
     * @return void
     * @throws ValidationException
     */
    public function createShoppingCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $validationRules = [
                'name' => new ValidationRule(ValidationType::String, false),
                'isShared' => new ValidationRule(ValidationType::Boolean, true),
            ];
            ValidationService::validateForm($validationRules);
            $formData = ValidationService::getFormData();
            ShoppingCartRepository::create(AuthService::$currentAccount->id, $formData["name"], $formData["isShared"]);
            header("Location: /user-area/shoppingCarts");
            return;
        }

        require_once __DIR__ . '/../views/user-area/createShoppingCart.php';
    }

    /**
     * Entfernt einen Eintrag aus dem Warenkorb
     *
     * @throws ValidationException
     */
    public function removeShoppingCartItem(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $validationRules = [
            'productTypeId' => new ValidationRule(ValidationType::Integer),
            'sizeId' => new ValidationRule(ValidationType::Integer),
            'colorId' => new ValidationRule(ValidationType::Integer),
            'accId' => new ValidationRule(ValidationType::Integer),
            'cartNumber' => new ValidationRule(ValidationType::Integer),
        ];
        // Formular validieren
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $account = AuthService::$currentAccount;

        $shoppingCart = ShoppingCartRepository::findShoppingCart($formData["accId"], $formData["cartNumber"]);
        if ($shoppingCart === null) {
            throw new ValidationException("Der Warenkorb existiert nicht");
        }

        if (false === ShoppingCartRepository::hasAccessTo($account, $shoppingCart)) {
            throw new LogicException("Du hast keinen Zugriff auf den Warenkorb");
        }
        ShoppingCartRepository::remove($shoppingCart, $formData['productTypeId'], $formData['sizeId'], $formData['colorId']);

        header("location: /user-area/shoppingCart?accId=" . $formData["accId"] . "&cartNumber=" . $formData["cartNumber"]);
    }

    /**
     * Kauft alle Elemente aus dem Warenkorb und löst einen Auftrag aus.
     *
     * @throws EmailException
     * @throws LogicException
     */
    public function purchase(): void
    {
        AuthService::checkAccess(AccountType::Customer);

        if (AuthService::$currentAccount === null || AuthService::$currentAccount->isBlocked) {
            throw new LogicException("Du bist blockiert. Du kannst nichts kaufen");
        }

        $validationRules = [
            'accId' => new ValidationRule(ValidationType::Integer),
            'cartNumber' => new ValidationRule(ValidationType::Integer),
        ];
        // Formular validieren
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $account = AuthService::$currentAccount;

        $shoppingCart = ShoppingCartRepository::findShoppingCart($formData["accId"], $formData["cartNumber"]);
        if ($shoppingCart === null) {
            throw new ValidationException("Der Warenkorb existiert nicht");
        }

        if (false === ShoppingCartRepository::hasAccessTo($account, $shoppingCart)) {
            throw new LogicException("Du hast keinen Zugriff auf den Warenkorb");
        }

        $quantityItemsCount = ShoppingCartRepository::getCountOfItems($shoppingCart);
        if ($quantityItemsCount === 0) {
            throw new LogicException("Dein Warenkorb ist leer");
        }

        $order = OrderRepository::create(AuthService::$currentAccount, 'Zahlung ausstehend');

        if ($order === null) {
            throw new LogicException("Die Bestellung wurde nicht erstellt");
        }

        $shoppingCartItems = ShoppingCartRepository::getAllProducts($shoppingCart);
        ProductRepository::assignToOrder(AuthService::$currentAccount->id, $order->id, $shoppingCartItems);
        EmailService::sendOrderConfirmation($order);

        header("location: /user-area/orders/view?id={$order->id}");
    }

    /**
     * Löscht einen Warenkorb für einen Nutzer
     *
     * @return void
     * @throws ValidationException
     * @throws LogicException
     */
    public function deleteShoppingCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $validationRules = [
            'cartNumber' => new ValidationRule(ValidationType::Integer, false)
        ];

        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        if ($formData["cartNumber"] === 1) {
            throw new LogicException("Du kannst nicht den Standard-Warenkorb löschen");
        }

        $account = AuthService::$currentAccount;
        ShoppingCartRepository::delete($account->id, $formData["cartNumber"]);
        header("Location: /user-area/shoppingCarts");
    }

}