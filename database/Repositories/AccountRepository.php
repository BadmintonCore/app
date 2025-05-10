<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Account;
use Vestis\Database\Models\AccountType;
use Vestis\Exception\DatabaseException;

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
     * @param bool $newsletter Whether the user subscribes to the newsletter
     * @return Account The created account
     * @throws DatabaseException
     */
    public static function create(AccountType $type, string $firstName, string $surname, string $username, string $email, string $password, bool $newsletter): Account
    {

        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

        var_dump($newsletter);
        $params = [
            "type" => $type->value,
            "firstName" => $firstName,
            "surname" => $surname,
            "username" => $username,
            "email" => $email,
            "password" => $hashedPassword,
            "newsletter" => $newsletter,
        ];

        QueryAbstraction::execute("INSERT INTO account (type, firstName, surname, username,  email, password, newsletter) VALUES (:type, :firstName, :surname, :username, :email, :password, :newsletter)", $params);
        return self::findByUsername($username);
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
}