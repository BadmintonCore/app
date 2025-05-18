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
        $message = sprintf(
            <<<EMAIL
            Hallo %s %s,
            danke, dass du dich bei Vestis registriert hast.
            Wir wünschen dir viel Spaß beim Shopping.
            
            Beste Grüße
            Dein Vestis Team

        EMAIL,
            $account->firstname,
            $account->surname
        );
        $headers = 'From: noreply@vestis.shop';
        if (false === mail($account->email, $subject, $message, $headers)) {
            throw new EmailException("Cannot send registration confirmation email");
        }
    }

    /**
     * Sendet ein neues, zufällig generiertes Passwort an den Nutzer
     *
     * @param Account $account Der Account, an den die E-Mail versendet werden soll
     * @return void
     * @throws EmailException Error, der bei dem E-Mail-Versandt auftritt
     */
    public static function sendNewPassword(Account $account): void
    {
        $subject = 'Dein neues Passwort';
        $message = sprintf(
            <<<EMAIL
            Hallo %s %s,
            hier ist dein neues Passwort: %s.
            Du kannst dein Passwort jederzeit im Benutzerbereich ändern.
            
            Beste Grüße
            Dein Vestis Team

        EMAIL,
            $account->firstname,
            $account->surname,
            PasswordGeneratorService::generatePassword($account)
        );
        $headers = 'From: noreply@vestis.shop';
        if (false === mail($account->email, $subject, $message, $headers)) {
            throw new EmailException("Kann Passwort-E-Mail nicht versenden");
        }
    }

}
