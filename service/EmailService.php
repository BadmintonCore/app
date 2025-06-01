<?php

namespace Vestis\Service;

use Vestis\Database\Models\Account;
use Vestis\Database\Models\Order;
use Vestis\Exception\EmailException;
use Vestis\Utility\PasswordGeneratorUtility;

/**
 * Service that handles email sending
 */
class EmailService
{
    private const string Headers = 'From: noreply@vestis.shop' . "\r\n" . "Content-type: text/plain; charset=UTF-8\r\n";

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
            
            danke, dass du dich bei vestis. registriert hast.
            Wir wünschen dir viel Spaß beim Shopping.
            
            Beste Grüße
            Dein vestis-Team

        EMAIL,
            $account->firstname,
            $account->surname
        );
        if (false === mail($account->email, $subject, $message, self::Headers)) {
            throw new EmailException("Cannot send registration confirmation email");
        }
    }


    public static function sendOrderConfirmation(Order $order): void
    {
        $subject = 'Auftrag erstellt';
        $message = sprintf(
            <<<EMAIL
            Hallo %s %s,
            
            du wir haben die Bestellung mit der ID: %s von dir erhalten.
            Bitte überweisen sie uns %s € an unser Hauptkonto mit der IBAN DE32 1111 1111 1111 1111.
            
            Beste Grüße
            Dein vestis-Team

        EMAIL,
            $order->getAccount()->firstname,
            $order->getAccount()->surname,
            $order->id,
            $order->getOrderSum()
        );
        if (false === mail($order->getAccount()->email, $subject, $message, self::Headers)) {
            throw new EmailException("Cannot send order confirmation email");
        }
    }

    public static function sendCancelConfirmation(Order $order): void
    {
        $subject = 'Auftrag storniert';
        $message = sprintf(
            <<<EMAIL
            Hallo %s %s,
            
            du wir haben die Bestellung mit der ID: %s von dir storniert.
            Du kriegst in den nächsten Tagen dein Geld zurück, solltest du welches gezahlt haben.
            
            Beste Grüße
            Dein vestis-Team

        EMAIL,
            $order->getAccount()->firstname,
            $order->getAccount()->surname,
            $order->id
        );
        if (false === mail($order->getAccount()->email, $subject, $message, self::Headers)) {
            throw new EmailException("Cannot send cancel confirmation email");
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
            Dein vestis-Team

        EMAIL,
            $account->firstname,
            $account->surname,
            PasswordGeneratorUtility::generatePassword($account)
        );
        if (false === mail($account->email, $subject, $message, self::Headers)) {
            throw new EmailException("Kann Passwort-E-Mail nicht versenden");
        }
    }

}
