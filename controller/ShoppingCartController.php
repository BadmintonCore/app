<?php

namespace Vestis\Controller;

use Vestis\Database\Models\Account;
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
        /** @var Account $account */
        $account = AuthService::$currentAccount;
        $ownedShoppingCarts = ShoppingCartRepository::findUserShoppingCarts($account);
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

        /** @var Account $account */
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

            /** @var Account $account */
            $account = AuthService::$currentAccount;
            ShoppingCartRepository::create($account->id, $formData["name"], $formData["isShared"]);
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

        /** @var Account $account */
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

        /** @var Account $account */
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

        $order ->completeOrder();

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

        /** @var Account $account */
        $account = AuthService::$currentAccount;
        ShoppingCartRepository::delete($account->id, $formData["cartNumber"]);
        header("Location: /user-area/shoppingCarts");
    }

    /**
     * Verarbeitet den Einladungslink zu einem Warenkorb.
     *
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
    public function acceptInvite(): void
    {
        AuthService::checkAccess(AccountType::Customer);

        $validationRules = [
            'cartNumber' => new ValidationRule(ValidationType::Integer),
            'secret' => new ValidationRule(ValidationType::String),
            'accId' => new ValidationRule(ValidationType::Integer),
        ];

        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $shoppingCart = ShoppingCartRepository::findShoppingCart($formData["accId"], $formData["cartNumber"]);
        if ($shoppingCart === null) {
            throw new LogicException("Der Warenkorb existiert nicht");
        }

        if ($shoppingCart->inviteSecret !== $formData["secret"]) {
            throw new LogicException("Falsches Invite Secret");
        }

        /** @var Account $account */
        $account = AuthService::$currentAccount;

        if ($shoppingCart->accId === $account->id) {
            throw new LogicException("Du bist der Besitzer des Warenkorbes");
        }

        if (true === ShoppingCartRepository::hasAccessTo($account, $shoppingCart)) {
            throw new LogicException("Du bist bereits Mitglied in diesem Warenkorb");
        }

        ShoppingCartRepository::addMemberToCart($account, $shoppingCart);
        header("Location: /user-area/shoppingCarts");
    }

    /**
     * Route damit der Nutzer einen Warenkorb verlassen kann.
     *
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
    public function leaveShoppingCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $validationRules = [
            'cartNumber' => new ValidationRule(ValidationType::Integer),
            'accId' => new ValidationRule(ValidationType::Integer),
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $shoppingCart = ShoppingCartRepository::findShoppingCart($formData["accId"], $formData["cartNumber"]);

        if ($shoppingCart === null) {
            throw new LogicException("Der Warenkorb existiert nicht");
        }

        /** @var Account $account */
        $account = AuthService::$currentAccount;

        if (false === ShoppingCartRepository::hasAccessTo($account, $shoppingCart)) {
            throw new LogicException("Du hast keinen Zugriff auf diesen Warenkorb");
        }

        if ($shoppingCart->accId === $account->id) {
            throw new LogicException("Du bist der Besitzer des Warenkorbes");
        }

        ShoppingCartRepository::removeMemberFromCart($account, $shoppingCart);
        header("Location: /user-area/shoppingCarts");
    }

    /**
     * Listet alle Mitglieder eines Warenkorbes auf
     *
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
    public function shoppingCartMembers(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $validationRules = [
            'cartNumber' => new ValidationRule(ValidationType::Integer),
            'accId' => new ValidationRule(ValidationType::Integer),
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();
        $shoppingCart = ShoppingCartRepository::findShoppingCart($formData["accId"], $formData["cartNumber"]);

        if ($shoppingCart === null) {
            throw new LogicException("Der Warenkorb existiert nicht");
        }
        if ($shoppingCart->accId !== AuthService::$currentAccount?->id) {
            throw new LogicException("Du hast keinen Zugriff auf die Mitgliederliste");
        }

        require_once __DIR__ . "/../views/user-area/shoppingCartMemberList.php";
    }

    /**
     * Entfernt ein Mitglied aus dem Warenkorb
     *
     * @return void
     * @throws LogicException
     * @throws ValidationException
     */
    public function removeMemberFromCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        $validationRules = [
            'cartNumber' => new ValidationRule(ValidationType::Integer),
            'accId' => new ValidationRule(ValidationType::Integer),
            'userId' => new ValidationRule(ValidationType::Integer),
        ];
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();
        $shoppingCart = ShoppingCartRepository::findShoppingCart($formData["accId"], $formData["cartNumber"]);

        if ($shoppingCart === null) {
            throw new LogicException("Der Warenkorb existiert nicht");
        }
        if ($shoppingCart->accId !== AuthService::$currentAccount?->id) {
            throw new LogicException("Du hast keinen Zugriff auf die Mitgliederliste");
        }

        ShoppingCartRepository::removeMember($shoppingCart, $formData["userId"]);
        header("Location: /user-area/shoppingCarts/members?cartNumber=" . $formData["cartNumber"] . "&accId=" . $formData["accId"]);
    }
}
