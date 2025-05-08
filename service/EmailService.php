<?php

namespace Vestis\Service;

use Vestis\Database\Models\Account;
use Vestis\Exception\EmailException;

class EmailService
{


    public static function sendRegistrationConfirmation(Account $account): void
    {
        $subject = 'Registrierung erfolgreich';
        $message = sprintf(<<<EMAIL
            Hallo %s %s,
            danke, dass du dich bei Vestis registriert hast.
            Wir wünschen dir viel Spaß beim Shopping.
            
            Beste Grüße
            Dein Vestis Team

        EMAIL,
        $account->firstname, $account->surname
        );
        $headers = 'From: noreply@vestis.shop';
        if (false === mail($account->email, $subject, $message, $headers)) {
            throw new EmailException("Cannot send registration confirmation email");
        }
    }

}