<?php

/*Autor(en): */

namespace Vestis\Controller;

use Vestis\Database\Repositories\OrderRepository;
use Vestis\Database\Repositories\ProductRepository;
use Vestis\Database\Repositories\ShoppingCartRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\EmailException;
use Vestis\Exception\LogicException;
use Vestis\Service\AccountService;
use Vestis\Database\Models\AccountType;
use Vestis\Exception\DatabaseException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\EmailService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für den Kundenbereich
 */
class UserAreaController
{
    /**
     * Leitet automatisch zur /user Seite weiter
     *
     * @return void
     */
    public function index(): void
    {
        header('Location: /user-area/user');
    }

    /**
     * Listet den Warenkorb auf.
     *
     * @throws ValidationException
     */
    public function shoppingCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        AuthService::setCurrentUserAccountSessionFromCookie();

        $account = AuthService::$currentAccount;

        if ($account !== null) {
            $groupedProducts = ShoppingCartRepository::getAllProducts($account);
        }

        require_once __DIR__ . '/../views/user-area/shoppingCart.php';

    }

    /**
     * Zeigt die Benutzer-Seite
     *
     * @return void
     */
    public function user(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'username' => new ValidationRule(ValidationType::String),
                'email' => new ValidationRule(ValidationType::Email),
                'password' => new ValidationRule(ValidationType::String),
            ];
            try {
                // Validate form
                ValidationService::validateForm($validationRules);
                $formData = ValidationService::getFormData();

                // Updated die eingegebenen Daten eines Benutzers
                AccountService::updateUserdata($formData['username'], $formData['email'], $formData['password']);

                //Den neuen Nutzer setzen
                AuthService::setCurrentUserAccountSessionFromCookie();


            } catch (ValidationException|AuthException|LogicException|DatabaseException $e) {
                // Setzt alle exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        require_once __DIR__ . '/../views/user-area/user.php';
    }

    /**
     * Ansicht für die Wunschliste
     *
     * @return void
     */
    public function wishlist(): void
    {
        require_once __DIR__ . '/../views/user-area/wishlist.php';
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
        ];
        // Formular validieren
        ValidationService::validateForm($validationRules, "GET");
        $formData = ValidationService::getFormData();

        $account = AuthService::$currentAccount;

        if ($account !== null) {
            ShoppingCartRepository::remove($account, $formData['productTypeId'], $formData['sizeId'], $formData['colorId']);
        }

        header("location: /user-area/shoppingCart");
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

        $quantityItemsCount = ShoppingCartRepository::getCountOfItems(AuthService::$currentAccount);
        if ($quantityItemsCount === 0) {
            throw new LogicException("Dein Warenkorb ist leer");
        }

        $order = OrderRepository::create(AuthService::$currentAccount, 'Zahlung ausstehend');

        if ($order === null) {
            throw new LogicException("Die Bestellung wurde nicht erstellt");
        }

        $shoppingCartItems = ShoppingCartRepository::getAllProducts(AuthService::$currentAccount);
        ProductRepository::assignToOrder(AuthService::$currentAccount->id, $order->id, $shoppingCartItems);
        EmailService::sendOrderConfirmation($order);

        header("location: /user-area/orders/view?id={$order->id}");
    }

}
/*Autor(en): */
