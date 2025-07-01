<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Service;

use Vestis\Database\Models\Account;
use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\AccountRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\ValidationException;

/**
 * Service, der sich um Benutzersitzungen kümmert
 */
class AuthService
{
    /**
     * @var Account|null Der Account, das mit dem JWT-Cookie der aktuellen Sitzung verknüpft ist
     */
    public static ?Account $currentAccount = null;

    /**
     * Die Dauer der Account-Sitzung in Sekunden (1 Stunde)
     */
    private const SESSION_DURATION = 3600;

    /**
     * Die Dauer der langen Kontositzung in Sekunden (7 Tage)
     */
    private const LONG_SESSION_DURATION = 3600 * 24 * 7;


    /**
     * Erzeugt ein neues JWT und setzt das erforderliche Cookie als Antwort-Header
     *
     * @param Account $account Der Account, auf dem im JWT der Sitzung verwiesen werden soll
     * @param int $sessionDuration
     * @return void
     * @throws ValidationException
     */
    public static function createUserAccountSession(Account $account, int $sessionDuration): void
    {
        $payload = [
            'accountId' => $account->id,
            'expiresAt' => time() + $sessionDuration, // die Zeit, bis die Sitzung abläuft
        ];

        $jwt = JWTService::generateJWT($payload);

        // Übergabe: Name des Cookies, Inhalt und Konfiguration
        setcookie("session", $jwt, [
            'expires' => time() + $sessionDuration, // setzt die Cookie-Ablaufzeit
            'path' => '/', // Das Cookie wird bei jeder Anfrage (egal auf welcher Seite) gesendet
            'secure' => false, // Die Anfrage wird auch über HTTP gesendet. Nicht nur HTTPS
            'httponly' => true, // Cookies können nicht über JavaScript geändert werden. Es existiert nur in HTTP
            'samesite' => 'Strict' // Das Cookie ist nur für denselben Ursprung zulässig
        ]);
    }

    /**
     * Zerstört die aktuelle User-Session
     *
     * @return void
     */
    public static function destroyCurrentSession(): void
    {
        self::$currentAccount = null;

        // Session-Cookie überschreiben mit Leeren String als Inhalt
        setcookie("session", "", [
            'path' => '/',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    /**
     * Meldet den Benutzer an. Das heißt, die Anmeldedaten werden überprüft. Falls die Anmeldung fehlgeschlagen ist, wird eine Exception geworfen.
     *
     * @param string $username Der Benutzername
     * @param string $password Das Passwort
     * @param bool $rememberMe
     * @return void
     * @throws AuthException|ValidationException
     */
    public static function loginUser(string $username, string $password, bool $rememberMe): void
    {
        $account = AccountRepository::findByUsername($username);
        if (null === $account) {
            throw new AuthException("Der Benutzername existiert nicht");
        }

        // Checkt, ob die gehashten Passwörter übereinstimmen
        if (!password_verify($password, $account->password)) {
            throw new AuthException("Falsches Passwort");
        }
        if ($rememberMe) {
            self::createUserAccountSession($account, self::LONG_SESSION_DURATION);
        } else {
            self::createUserAccountSession($account, self::SESSION_DURATION);
        }
    }

    /**
     * Prüft, ob der Benutzer derzeit angemeldet ist und den angegebenen Accounttyp hat.
     * Wenn der Benutzer nicht angemeldet ist oder einen anderen Accounttyp hat, wird er zur Anmeldeseite weitergeleitet
     *
     * @param AccountType|null $type Der Accounttyp
     * @return void
     */
    public static function checkAccess(?AccountType $type = null): void
    {
        if (null === self::$currentAccount) {
            header("Location: /auth/login");
            die();
        }
        if ($type !== null && self::$currentAccount->type !== $type) {
            header("Location: /auth/login");
            die();
        }
    }

    /**
     * Prüft, ob der aktuelle Benutzer ein Kunde ist
     *
     * @return bool
     */
    public static function isCustomer(): bool
    {
        if (null !== self::$currentAccount) {
            return self::$currentAccount->type === AccountType::Customer;
        }
        return false;
    }

    /**
     * Prüft, ob der aktuelle Benutzer ein Admin ist
     *
     * @return bool
     */
    public static function isAdmin(): bool
    {
        if (null !== self::$currentAccount) {
            return self::$currentAccount->type === AccountType::Administrator;
        }
        return false;
    }

    /**
     * Ruft den JWT aus dem Sitzungscookie ab und holt den zugehörigen Account, der dann in einer statischen Variable gespeichert wird
     *
     * @return void
     * @throws ValidationException
     */
    public static function setCurrentUserAccountSessionFromCookie(): void
    {
        /** @var string|null $sessionCookie */
        $sessionCookie = $_COOKIE['session'] ?? null;
        if ($sessionCookie !== null && trim($sessionCookie) !== '') {
            $payload = JWTService::verifyJWT($sessionCookie);

            if ($payload['expiresAt'] > time()) {
                /** @var int $accountId */
                $accountId = $payload['accountId'];
                self::$currentAccount = AccountRepository::findById($accountId);
            }
        }
    }

}
