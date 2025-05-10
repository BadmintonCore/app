<?php

namespace Vestis\Service;

use Vestis\Database\Models\Account;
use Vestis\Exception\EmailException;

/**
 * Service that handles email sending
 */
class EmailService
{

    /**
     * Sends a registration confirmation email to the account owner.
     *
     * @param Account $account The account that the mail should be sent to
     * @return void
     * @throws EmailException On error while sending email
     */
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