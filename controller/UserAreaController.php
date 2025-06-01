<?php
/*Autor(en): */

namespace Vestis\Controller;

use Vestis\Database\Repositories\ShoppingCartRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\LogicException;
use Vestis\Service\AccountService;
use Vestis\Database\Models\AccountType;
use Vestis\Exception\DatabaseException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für den Kundenbereich
 */
class UserAreaController
{

    /**
     * Aktualisiert die Nutzerdaten eines Nutzers
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
     * Ansicht für den Einkaufswagen
     *
     * @throws ValidationException
     * @return void
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
     * Entfernt eine Position aus dem Einkaufswagen
     *
     * @throws ValidationException
     * @return void
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

}
/*Autor(en): */