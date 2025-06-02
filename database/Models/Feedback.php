<?php

namespace Vestis\Database\Models;

/**
 * Das Model für ein Feedback in der Datenbank
 */
class Feedback
{
    public int $id;

    public string $name;

    public string $evaluation;

    public string $email;

    public string $message;

    public string $createdAt;
}
