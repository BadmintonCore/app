<?php

//Author: Lasse Hoffmann

namespace Vestis\Service;

use Vestis\Database\Repositories\AccountRepository;
use Vestis\Exception\AuthException;
use Vestis\Exception\UpdateException;

class UpdateService
{
    /**
     * Aktualisiert die Benutzerdaten, die im User-Bereich eingegeben wurden.
     *
     * @param string $newUsername Der neue Benutzername des Nutzers
     * @param string $newEmail Die neue E-Mail des Nutzers
     * @param string $newPassword Das neue Passwort des Nutzers
     * @throws UpdateException
     * @throws AuthException
     */
    public static function updateUserdata(string $newUsername, string $newEmail, string $newPassword): void
    {
        $currentUsername = AuthService::$currentAccount?->username;
        $currentEmail = AuthService::$currentAccount?->email;

        if (null === $currentUsername || null === $currentEmail) {
            throw new AuthException("There is no current username or email");
        }

        //Ändert den Benutzernamen des Nutzers, sollte dieser nicht schon existieren
        if ($currentUsername !== $newUsername) {
            if (null !== AccountRepository::findByUsername($newUsername)) {
                AccountRepository::updateUsername($newUsername, $currentUsername);
            } else {
                throw new UpdateException("Der Benutzername wird bereits verwendet!");
            }
        }

        //Ändert die E-Mail des Nutzers, sollte diese nicht schon existieren
        if ($currentEmail !== $newEmail) {
            if (null !== AccountRepository::findByEmail($newEmail)) {
                AccountRepository::updateEmail($newEmail, $currentEmail);
            } else {
                throw new UpdateException("Die E-Mail wird bereits verwendet!");
            }
        }

        //Ändert das Passwort des Nutzers (immer, da ein Passwort benötigt wird, dass das Formular abgesendet werden kann (siehe AuthValidation.js)
        AccountRepository::updatePassword($newPassword, $newUsername);
    }
}
