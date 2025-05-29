<?php

namespace Vestis\Service;

use Vestis\Database\Models\Account;
use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\AccountRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\ValidationException;

/**
 * Service that handles everything regarding user sessions
 */
class AuthService
{
    /**
     * @var Account|null The account associated with the current session JWT cookie
     */
    public static ?Account $currentAccount = null;

    /**
     * The duration of the account session in seconds (1 hour)
     */
    private const SESSION_DURATION = 3600;

    /**
     * The duration of the account session in seconds (400 days)
     */
    private const SESSION_DURATION_LONG = 400 * 86400;

    /**
     * Creates a new JWT and sets the required cookie as response header
     *
     * @param Account $account The account that should be referenced in the session JWT
     * @return void
     */
    public static function createUserAccountSession(Account $account): void
    {
        $payload = [
            'accountId' => $account->id,
            'expiresAt' => time() + self::SESSION_DURATION, // the time at which the session expires
        ];

        $jwt = JWTService::generateJWT($payload);

        setcookie("session", $jwt, [
            'expires' => time() + self::SESSION_DURATION, // sets the cookie expiry date
            'path' => '/', // The cookie is sent with every request on the page
            'secure' => false, // Request is also sent via http. Not only https
            'httponly' => true, // Cookie cannot be modified from JavaScript. It only exists in HTTP
            'samesite' => 'Strict' // The cookie is only allowed on the same origin
        ]);
    }

    /**
     * Creates a new JWT and sets the required cookie as response header
     *
     * @param Account $account The account that should be referenced in the session JWT
     * @return void
     */
    public static function createUserAccountSessionWithLongDuration(Account $account): void
    {
        $payload = [
            'accountId' => $account->id,
            'expiresAt' => time() + self::SESSION_DURATION_LONG, // the time at which the session expires
        ];

        $jwt = JWTService::generateJWT($payload);

        setcookie("session", $jwt, [
            'expires' => time() + self::SESSION_DURATION_LONG, // sets the cookie expiry date
            'path' => '/', // The cookie is sent with every request on the page
            'secure' => false, // Request is also sent via http. Not only https
            'httponly' => true, // Cookie cannot be modified from JavaScript. It only exists in HTTP
            'samesite' => 'Strict' // The cookie is only allowed on the same origin
        ]);
    }

    /**
     * Destroys the current user session
     *
     * @return void
     */
    public static function destroyCurrentSession(): void
    {
        self::$currentAccount = null;
        setcookie("session", "", [
            'path' => '/',
            'secure' => false,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    /**
     * Logs in the user. This means the credentials are checked. In case the login failed an exception is thrown.
     *
     * @param string $username The username entered by the user
     * @param string $password The password entered by the user
     * @param bool $rememberMe
     * @return void
     * @throws AuthException The exception in case the user prompted the wrong credentials
     */
    public static function loginUser(string $username, string $password, bool $rememberMe): void
    {
        $account = AccountRepository::findByUsername($username);
        if (null === $account) {
            throw new AuthException("user does not exist");
        }

        // Checks whether the password hashes are equal
        if (!password_verify($password, $account->password)) {
            throw new AuthException("wrong password");
        }
        if ($rememberMe) {
            self::createUserAccountSessionWithLongDuration($account);
        } else {
            self::createUserAccountSession($account);
        }
    }

    /**
     * Checks whether the user is currently logged in and has the provided account type.
     * If the user is not logged in or has another account type he is redirected to login page
     *
     * @param AccountType $type The required account type
     * @return void
     */
    public static function checkAccess(AccountType $type): void
    {
        if (null === self::$currentAccount) {
            header("Location: /auth/login");
            die();
        }
        if (self::$currentAccount->type !== $type) {
            header("Location: /auth/login");
            die();
        }
    }

    /**
     * Checks whether the current user is a customer
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
     * Checks whether the current user is an admin
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
     * Obtains the JWT from the session cookie and fetches the associated account which is then stored into static variable
     *
     * @return void
     * @throws ValidationException Thrown on invalid JWT
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
