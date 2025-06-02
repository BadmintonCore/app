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
     * Erstellt einen neuen Account
     *
     * @param AccountType $type Der Accounttyp
     * @param string $firstName Vorname des Nutzers
     * @param string $surname Nachname des Benutzers
     * @param string $username Der Benutzername, der für die Anmeldung verwendet wird
     * @param string $email Die E-Mail, die für die Anmeldung verwendet wird
     * @param string $password Das Passwort, welches gehasht wird
     * @throws DatabaseException
     * @return Account|null Der erstellte Account
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
     * Aktualisiert den Benutzername eines Accounts
     *
     * @param string $newUsername Der neue Benutzername, der für die Anmeldung verwendet wird
     * @param string $oldUsername Der alte Benutzername, der für die Anmeldung verwendet worden ist
     * @throws DatabaseException
     * @return Account|null Der erstellte Account
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
     * Aktualisiert die E-Mail des Accounts
     *
     * @param string $newEmail Die neue E-Mail eines Accounts
     * @param string $oldEmail Die alte E-Mail eines Accounts
     * @throws DatabaseException
     * @return Account|null Der erstellte Account
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
     * Aktualisiert das Passwort des Accounts
     *
     * @param string $newPassword Das neue Passwort eines Accounts
     * @param string $username Der Benutzername, der für die Anmeldung verwendet wird
     * @return Account|null Der erstellte Account
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
     * Findet einen Account anhand des Benutzernamens
     *
     * @param string $username Der Benutzername
     * @return Account|null Der gefundene Account oder null
     * @throws DatabaseException
     */
    public static function findByUsername(string $username): ?Account
    {
        return QueryAbstraction::fetchOneAs(Account::class, "SELECT * FROM account WHERE username = :username", ["username" => $username]);
    }

    /**
     * Findet einen Account anhand seiner ID
     *
     * @param int $id Die ID
     * @return Account|null Der gefundene Account oder null
     * @throws DatabaseException
     */
    public static function findById(int $id): ?Account
    {
        return QueryAbstraction::fetchOneAs(Account::class, "SELECT * FROM account WHERE id = :id", ["id" => $id]);
    }

    /**
     * Findet einen Account anhand seiner E-Mail
     *
     * @param string $email Die E-Mail
     * @return Account|null Der gefundene Account oder null
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
     * @param int $id die ID des Accounts
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
