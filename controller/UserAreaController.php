<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Controller;

use Vestis\Exception\AuthException;
use Vestis\Exception\LogicException;
use Vestis\Service\AccountService;
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
                // Formular validieren
                ValidationService::validateForm($validationRules);
                $formData = ValidationService::getFormData();

                // Aktualisiert die eingegebenen Daten eines Benutzers
                AccountService::updateUserdata($formData['username'], $formData['email'], $formData['password']);

                // Den neuen Benutzer setzen
                AuthService::setCurrentUserAccountSessionFromCookie();


            } catch (ValidationException|AuthException|LogicException|DatabaseException $e) {
                // Setzt alle Exceptions, die dann im Frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        require_once __DIR__ . '/../views/user-area/user.php';
    }

}
