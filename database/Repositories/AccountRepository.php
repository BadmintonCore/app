<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Account;
use Vestis\Database\Models\AccountType;
use Vestis\Exception\DatabaseException;

/**
 * Repository für @see Account
 */
class AccountRepository
{
    /**
     * Creates a new account
     *
     * @param AccountType $type The type of the account
     * @param string $firstName First name of the account owner
     * @param string $surname Surname of the owner
     * @param string $username The username, that is used for login purposes
     * @param string $email The email, that is used for login purposes
     * @param string $password The password that is hashed later
     * @return Account|null The created account
     * @throws DatabaseException
     */
    public static function create(AccountType $type, string $firstName, string $surname, string $username, string $email, string $password): ?Account
    {

        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

        $params = [
            "type" => $type->value,
            "firstName" => $firstName,
            "surname" => $surname,
            "username" => $username,
            "email" => $email,
            "password" => $hashedPassword
        ];

        return QueryAbstraction::executeReturning(Account::class, "INSERT INTO account (type, firstName, surname, username,  email, password) VALUES (:type, :firstName, :surname, :username, :email, :password)", $params);
    }

    /**
     * Updates a username of an account
     *
     * @param string $newUsername The new username, that is used for login purposes
     * @param string $oldUsername The old username, that is used for login purposes
     * @return Account|null The created account
     * @throws DatabaseException
     */
    public static function updateUsername(string $newUsername, string $oldUsername): ?Account
    {

        $params = [
            "newUsername" => $newUsername,
            "oldUsername" => $oldUsername,
        ];

        return QueryAbstraction::executeReturning(Account::class, "UPDATE account SET username = :newUsername WHERE username = :oldUsername;", $params);
    }

    /**
     * Updates an email of an account
     *
     * @param string $newEmail The new email of an account
     * @param string $oldEmail The old email of an account
     * @return Account|null The created account
     * @throws DatabaseException
     */
    public static function updateEmail(string $newEmail, string $oldEmail): ?Account
    {

        $params = [
            "newEmail" => $newEmail,
            "oldEmail" => $oldEmail,
        ];

        return QueryAbstraction::executeReturning(Account::class, "UPDATE account SET email = :newEmail WHERE email = :oldEmail;", $params);
    }

    /**
     * Updates a password of an account
     *
     * @param string $newPassword The new password of an account
     * @param string $username The username, that is used for login purposes
     * @return Account|null The created account
     * @throws DatabaseException
     */
    public static function updatePassword(string $newPassword, string $username): ?Account
    {

        $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);

        $params = [
            "newPassword" => $hashedPassword,
            "username" => $username,
        ];

        return QueryAbstraction::executeReturning(Account::class, "UPDATE account SET password = :newPassword WHERE username = :username;", $params);
    }

    /**
     * Finds an account by the username
     *
     * @param string $username The username
     * @return Account|null The fetched account or null
     * @throws DatabaseException
     */
    public static function findByUsername(string $username): ?Account
    {
        return QueryAbstraction::fetchOneAs(Account::class, "SELECT * FROM account WHERE username = :username", ["username" => $username]);
    }

    /**
     * Finds an account by the ID
     *
     * @param int $id The ID
     * @return Account|null The fetched account or null
     * @throws DatabaseException
     */
    public static function findById(int $id): ?Account
    {
        return QueryAbstraction::fetchOneAs(Account::class, "SELECT * FROM account WHERE id = :id", ["id" => $id]);
    }

    /**
     * Finds an account by the Email
     *
     * @param string $email The Email
     * @return Account|null The fetched account or null
     * @throws DatabaseException
     */
    public static function findByEmail(string $email): ?Account
    {
        return QueryAbstraction::fetchOneAs(Account::class, "SELECT * FROM account WHERE email = :email", ["email" => $email]);
    }

    /**
     * Lädt alle Kunden paginiert.
     *
     * @param int $page Die Seite, die geladen werden soll
     * @param int $perPage Die Anzahl an Einträgen pro Seite
     * @return PaginationDto<Account>
     */
    public static function findCustomersPaginated(int $page, int $perPage): PaginationDto
    {
        return QueryAbstraction::fetchManyAsPaginated(Account::class, "SELECT * FROM account WHERE type = 'C'", $page, $perPage);
    }

    /**
     * Löscht einen Account
     *
     * @param int $id die ID des Account, der gelöscht werden soll
     * @return void
     */
    public static function deleteById(int $id): void
    {
        QueryAbstraction::execute("DELETE FROM account WHERE id = :id", ["id" => $id]);
    }

    /**
     * Setzt den Blockier-Status für einen Nutzer
     *
     * @param int $id Die ID des Nutzers
     * @param bool $blocked Ob der Nutzer blockiert sein soll
     * @return void
     */
    public static function setBlocked(int $id, bool $blocked): void
    {
        QueryAbstraction::execute("UPDATE account SET isBlocked = :blocked WHERE id = :id", ["id" => $id, "blocked" => $blocked]);
    }
}
