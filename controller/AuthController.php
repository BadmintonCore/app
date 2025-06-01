<?php
/*Autor(en): */

namespace Vestis\Controller;

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\AccountRepository;
use Vestis\Database\Repositories\ShoppingCartRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\DatabaseException;
use Vestis\Exception\DatabaseExceptionReason;
use Vestis\Exception\EmailException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AccountService;
use Vestis\Service\AuthService;
use Vestis\Service\EmailService;
use Vestis\Service\NewsletterService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

/**
 * Controller für die Authentifizierung
 */
class AuthController
{
    /**
     * Ansicht für die Anmeldung
     *
     * @return void
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'username' => new ValidationRule(ValidationType::String),
                'password' => new ValidationRule(ValidationType::String),
                'rememberMe' => new ValidationRule(ValidationType::Boolean, true),
            ];
            try {
                // Formular validieren
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                // Benutzer mit den gegebenen Formular-Werten einloggen
                AuthService::loginUser($formData['username'], $formData['password'], $formData['rememberMe']);

                // Umleitung zur Startseite nach erfolgreichem Login
                if (AuthService::isAdmin()) {
                    header("Location: /admin");
                } else {
                    header("Location: /");
                }
                return;
            } catch (ValidationException|AuthException|DatabaseException $e) {
                // Setzt alle Exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }

        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Ansicht zum Abmelden
     *
     * @return void
     */
    public function logout(): void
    {
        AuthService::destroyCurrentSession();
        require_once __DIR__ . "/../views/auth/logout.php";
    }

    /**
     * Ansicht zum Registrieren
     *
     * @return void
     */
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
                // Formular validieren
                ValidationService::validateForm($validationRules);

                $formData = ValidationService::getFormData();

                $account = AccountRepository::create(AccountType::Customer, $formData['firstName'], $formData['surname'], $formData['username'], $formData['email'], $formData['password']);

                if (null === $account) {
                    $validationError = "Account konnte nicht erstellt werden";
                    require_once __DIR__ . '/../views/auth/registration.php';
                    return;
                }

                // Erstellt den zugehörigen Warenkorb für einen Nutzer
                ShoppingCartRepository::create($account->id);

                if ($formData['newsletter'] === true) {
                    NewsletterService::subscribe($account->email);
                }

                // Sendet eine Bestätigungs-Mail und erstellt eine Session (Session-Cookie)
                EmailService::sendRegistrationConfirmation($account);
                AuthService::createUserAccountSession($account, 3600); //Eine Stunde in Sekunden

                // Umleitung zur Startseite
                header("Location: /");
                die();
            } catch (ValidationException|EmailException $e) {
                $validationError = $e->getMessage();
            } catch (DatabaseException $e) {
                if ($e->getReason() === DatabaseExceptionReason::ViolatedUniqueConstraint) {
                    var_dump($e->getMessage());
                    $validationError = sprintf("%s existiert bereits.", $e->getColumnName());
                } else {
                    $validationError = $e->getMessage();
                }
            }
        }
        require_once __DIR__ . '/../views/auth/registration.php';
    }

    /**
     * Ansicht zum Zurücksetzen des Passwort
     *
     * @throws \Exception
     * @return void
     */
    public function resetPassword(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $validationRules = [
                'mail' => new ValidationRule(ValidationType::Email)
            ];
            try {
                // Formular validieren
                ValidationService::validateForm($validationRules);

                ['mail' => $mail] = ValidationService::getFormData();

                $findByEmail = AccountRepository::findByEmail($mail);

                // Wenn die E-Mail nicht null ist (sie existiert)
                if (null !== $findByEmail) {
                    EmailService::sendNewPassword($findByEmail);
                } else {
                    throw new \Exception("Es konnte kein Benutzer mit dieser E-Mail gefunden werden.");
                }
                $successMessage = "Dein neues Passwort wurde erfolgreich an deine E-Mail gesendet.";
            } catch (\Exception|ValidationException|EmailException|DatabaseException $e) {
                // Setzt alle Exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }
        }
        require_once __DIR__ . '/../views/auth/reset.php';
    }

    /**
     * Ansicht um die Account-Löschung zu bestätigen
     *
     * @throws ValidationException
     * @return void
     */
    public function deleteConfirmation(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            // Aktuellen Account aus den Cookies setzen
            AuthService::setCurrentUserAccountSessionFromCookie();
            $account = AuthService::$currentAccount;

            try {

                // Account löschen
                if ($account !== null) {
                    AccountService::deleteAccount($account);
                }

                // Aktuelle Session auflösen
                AuthService::destroyCurrentSession();

            } catch (\Exception|DatabaseException $e) {
                // Setzt alle Exceptions, die dann im frontend angezeigt werden
                $errorMessage = $e->getMessage();
            }

            // Zurück zur Startseite
            header("Location: /");
            return;
        }
        require_once __DIR__ . '/../views/auth/deleteConfirmation.php';
    }
}
/*Autor(en): */