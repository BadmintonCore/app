<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Newsletter;

class NewsletterRepository
{
    public static function subscribe(string $email): void
    {
        QueryAbstraction::execute("INSERT INTO newsletter (email) VALUES (:email)", ['email' => $email]);
    }

    public static function unsubscribe(string $email): void
    {
        QueryAbstraction::execute("DELETE FROM newsletter WHERE email = :email", ['email' => $email]);
    }

    public static function unsubscribeAll(): void
    {
        QueryAbstraction::execute("DELETE FROM newsletter");
    }

    public static function search(string $email): ?Newsletter
    {
        return QueryAbstraction::fetchOneAs(Newsletter::class, "SELECT * FROM newsletter WHERE email = :email", ['email' => $email]);
    }
}
