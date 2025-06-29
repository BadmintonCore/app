<?php

//Autor(en): Lasse Hoffmann

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Newsletter;

/**
 * Repository für @see Newsletter
 */
class NewsletterRepository
{
    /**
     * Erstellt einen neuen Newsletter Eintrag
     *
     * @param string $email
     * @return void
     */
    public static function subscribe(string $email): void
    {
        QueryAbstraction::execute("INSERT INTO newsletter (email) VALUES (:email)", ['email' => $email]);
    }

    /**
     * Löscht einen Newsletter-Eintrag
     *
     * @param string $email
     * @return void
     */
    public static function unsubscribe(string $email): void
    {
        QueryAbstraction::execute("DELETE FROM newsletter WHERE email = :email", ['email' => $email]);
    }

    /**
     * Löscht alle Newsletter-Einträge
     *
     * @return void
     */
    public static function unsubscribeAll(): void
    {
        QueryAbstraction::execute("DELETE FROM newsletter");
    }

    /**
     * Sucht einen Newsletter-Eintrag
     *
     * @param string $email
     * @return Newsletter|null
     */
    public static function search(string $email): ?Newsletter
    {
        return QueryAbstraction::fetchOneAs(Newsletter::class, "SELECT * FROM newsletter WHERE email = :email", ['email' => $email]);
    }
}
//Autor(en): Lasse Hoffmann
