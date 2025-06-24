<?php

//Autor(en): Mathis Burger

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
     * Zeigt die Benutzer-Seite
     *
     * @return void
     */
    public function user(): void
    {
        AuthService::checkAccess();
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

}
//Autor(en): Mathis Burger