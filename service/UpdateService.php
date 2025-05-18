<?php
//Author: Lasse Hoffmann

namespace Vestis\Service;

use Vestis\Database\Repositories\AccountRepository;
use Vestis\Exception\UpdateException;

class UpdateService
{

    /**
     * Aktualisiert die Benutzerdaten, die im User-Bereich eingegeben wurden.
     *
     * @param string $username Der neue Benutzername des Nutzers
     * @param string $email Die neue E-Mail des Nutzers
     * @param string $password Das neue Passwort des Nutzers
     * @throws UpdateException
     */
    public static function updateUserdata(string $username, string $email, string $password): void
    {
        $currentUsername = AuthService::$currentAccount?->username;
        $currentEmail = AuthService::$currentAccount?->email;
        $newUsername = $username;
        $newEmail = $email;
        $newPassword = $password;

        //Ändert den Benutzernamen des Nutzers, sollte dieser nicht schon existieren
        if ($currentUsername !== $newUsername) {
            if (!AccountRepository::findByUsername($newUsername)) {
                AccountRepository::updateUsername($newUsername, $currentUsername);
            } else {
                throw new UpdateException("username already exists");
            }
        }

        //Ändert die E-Mail des Nutzers, sollte diese nicht schon existieren
        if ($currentEmail !== $newEmail) {
            if (!AccountRepository::findByEmail($newEmail)) {
                AccountRepository::updateEmail($newEmail, $currentEmail, $newUsername);
            } else {
                throw new UpdateException("email already exists");
            }
        }

        //Ändert das Passwort des Nutzers (immer, da ein Passwort benötigt wird, dass das Formular abgesendet werden kann (siehe AuthValidation.js)
        AccountRepository::updatePassword($newPassword, $newUsername);
    }
}

