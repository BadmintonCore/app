<?php

namespace Vestis\Database\Repositories;

use Vestis\Database\Models\Feedback;
use Vestis\Exception\DatabaseException;

class FeedbackRepository
{
    /**
     * Erstellt ein neues Feedback
     *
     * @param string $name Der vollständige Name des Absenders (Pseudo-Name)
     * @param int $evaluation Die Bewertung des Nutzers von 1 bis 5
     * @param string $email Die E-Mail des "Ausfüllers"
     * @param string $message Die Nachricht des Feedbacks
     * @return Feedback|null The created account
     * @throws DatabaseException
     */
    public static function createFeedback(string $name, int $evaluation, string $email, string $message): ?Feedback
    {

        $datetime = date("o-m-d H:i:s");

        $params = [
            "name" => $name,
            "evaluation" => $evaluation,
            "email" => $email,
            "message" => $message,
            "createdAt" => $datetime
        ];

        return QueryAbstraction::executeReturning(Feedback::class, "INSERT INTO feedback (name, evaluation, email, message, createdAt) VALUES (:name, :evaluation, :email, :message, :createdAt)", $params);
    }
}
