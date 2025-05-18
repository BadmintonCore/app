<?php

namespace Vestis\Controller;

use Vestis\Exception\UpdateException;
use Vestis\Service\UpdateService;
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
                UpdateService::updateUserdata($username, $email, $password);

                // Ruft die Seite erneut auf, damit die Daten im Form neu geladen werden
                header("Location: /user-area/user");
                return;
            } catch (ValidationException|UpdateException|DatabaseException $e) {
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
