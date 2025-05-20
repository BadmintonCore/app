<?php

namespace Vestis\Controller;

use Vestis\Database\Models\Account;
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

class UserAreaController
{
    public function shoppingCart(): void
    {
        AuthService::checkAccess(AccountType::Customer);
        require_once __DIR__ . '/../views/user-area/shoppingCart.php';
    }

    //Author: Lasse Hoffmann
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

                /** @var string $username */
                /** @var string $email */
                /** @var string $password */
                ['username' => $username, 'email' => $email, 'password' => $password] = ValidationService::getFormData();

                // Updated die eingegebenen Daten eines Benutzers
                AccountService::updateUserdata($username, $email, $password);

                //Den neuen Nutzer setzen
                AuthService::setCurrentUserAccountSessionFromCookie();

            } catch (ValidationException|AuthException|LogicException|DatabaseException $e) {
                // Setzt alle exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        require_once __DIR__ . '/../views/user-area/user.php';
    }

    public function wishlist(): void
    {
        require_once __DIR__ . '/../views/user-area/wishlist.php';
    }

}
