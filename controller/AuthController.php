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

                /** @var string $username */
                /** @var string $password */
                ['username' => $username, 'password' => $password] = ValidationService::getFormData();

                // Login the user with the given credentials in $_POST
                AuthService::loginUser($username, $password);

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

                $formData = ValidationService::getFormData();

                /** @phpstan-ignore-next-line all selected parameters are checked before for type safety in form validation */
                $account = AccountRepository::create(AccountType::Customer, $formData['firstName'], $formData['surname'], $formData['username'], $formData['email'], $formData['password'], $formData['newsletter'] ?? false);

                if (null === $account) {
                    $validationError = "Cannot create an account";
                    require_once __DIR__.'/../views/auth/registration.php';
                    return;
                }

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

    /**
     * @throws \Exception
     */
    public function resetPassword(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'mail' => new ValidationRule(ValidationType::Email)
            ];
            try {
                // Validate form
                ValidationService::validateForm($validationRules);

                /** @var string $mail */
                ['mail' => $mail] = ValidationService::getFormData();

                $findByEmail = AccountRepository::findByEmail($mail);

                //Wenn die E-Mail nicht null ist (sie existiert)
                if (null !== $findByEmail) {
                    EmailService::sendNewPassword($findByEmail);
                } else {
                    throw new \Exception("Es konnte kein Benutzer mit dieser E-Mail gefunden werden.");
                }
                $successMessage = "Dein neues Passwort wurde erfolgreich an deine E-Mail gesendet.";
            } catch (\Exception|ValidationException|EmailException|DatabaseException $e) {
                // Setzt alle exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        require_once __DIR__.'/../views/auth/reset.php';
    }
}
