<?php

namespace Vestis\Service;

use Vestis\Database\Models\Account;
use Vestis\Exception\EmailException;
use Vestis\Utility\PasswordGeneratorUtility;

/**
 * Service, der sich um den E-Mail-Versand kümmert
 */
class EmailService
{
    private const string Headers = 'From: noreply@vestis.shop' . "\r\n" . "Content-type: text/plain; charset=UTF-8\r\n";

    /**
     * Sendet eine E-Mail zur Bestätigung der Registrierung an den Accountinhaber
     *
     * @param Account $account Der Account, an den die E-Mail gesendet werden soll
     * @return void
     * @throws EmailException Exception, die bei dem E-Mail-Versandt auftritt
     */
    public static function sendRegistrationConfirmation(Account $account): void
    {
        $subject = 'Registrierung erfolgreich';
        $message = sprintf(
            <<<EMAIL
            Hallo %s %s,
            
            danke, dass du dich bei vestis. registriert hast.
            Wir wünschen dir viel Spaß beim Shopping.
            
            Beste Grüße
            Dein vestis-Team

        EMAIL,
            $account->firstname,
            $account->surname
        );
        if (false === mail($account->email, $subject, $message, self::Headers)) {
            throw new EmailException("Kann Registrierungs-Mail nicht versenden.");
        }
    }

    /**
     * Sendet ein neues, zufällig generiertes Passwort an den Nutzer
     *
     * @param Account $account Der Account, an den die E-Mail versendet werden soll
     * @return void
     * @throws EmailException Exception, die bei dem E-Mail-Versandt auftritt
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
            Dein vestis-Team

        EMAIL,
            $account->firstname,
            $account->surname,
            PasswordGeneratorUtility::generatePassword($account)
        );
        if (false === mail($account->email, $subject, $message, self::Headers)) {
            throw new EmailException("Kann Passwort-Mail nicht versenden.");
        }
    }

}
