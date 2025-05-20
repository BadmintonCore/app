<?php

namespace Vestis\Database\Models;

/**
 * Das Feedback-Modell, das die Daten der Feedback-Datenbanktabelle darstellt
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
