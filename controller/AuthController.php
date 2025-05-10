<?php

namespace Vestis\Controller;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\AccountRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\DatabaseException;
use Vestis\Exception\DatabaseExceptionReason;
use Vestis\Exception\EmailException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\EmailService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

class AuthController
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'username' => new ValidationRule(ValidationType::String),
                'password' => new ValidationRule(ValidationType::String),
            ];
            try {
                // Validate form
                ValidationService::validateForm($validationRules);

                // Login the user with the given credentials in $_POST
                AuthService::loginUser($_POST["username"], $_POST["password"]);

                // Redirect to landing page after successful login
                header("Location: /");
                return;
            } catch (ValidationException|AuthException|DatabaseException $e) {
                // Sets all exception errors. Those are then displayed in the frontend
                $errorMessage = $e->getMessage();
            }

        }
        require_once __DIR__.'/../views/auth/login.php';
    }

    public function logout(): void
    {
        AuthService::destroyCurrentSession();
        require_once __DIR__."/../views/auth/logout.php";
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'firstName' => new ValidationRule(ValidationType::String),
                'surname' => new ValidationRule(ValidationType::String),
                'username' => new ValidationRule(ValidationType::String),
                'email' => new ValidationRule(ValidationType::Email),
                'password' => new ValidationRule(ValidationType::String),
                'newsletter' => new ValidationRule(ValidationType::Boolean, true),
            ];
            try {
                // Validates the form
                ValidationService::validateForm($validationRules);

                // Creates the customer account
                $account = AccountRepository::create(AccountType::Customer, $_POST['firstName'], $_POST['surname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['newsletter'] ?? false);

                // Sends confirmation mail and creates user session cookie
                EmailService::sendRegistrationConfirmation($account);
                AuthService::createUserAccountSession($account);

                // Redirects to landing page
                header("Location: /");
                die();
            } catch (ValidationException|EmailException $e) {
                $validationError = $e->getMessage();
            } catch (DatabaseException $e) {
                if ($e->getReason() === DatabaseExceptionReason::ViolatedUniqueConstraint) {
                    var_dump($e->getMessage());
                    $validationError = sprintf("%s already exists.", $e->getColumnName());
                } else {
                    $validationError = $e->getMessage();
                }
            }
        }
        require_once __DIR__.'/../views/auth/registration.php';
    }

    public function resetPassword(): void
    {
        require_once __DIR__.'/../views/auth/reset.php';
    }
}
