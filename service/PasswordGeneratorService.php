<?php

//Author: Lasse Hoffmann

namespace Vestis\Service;

use Vestis\Database\Models\Account;
use Vestis\Database\Repositories\AccountRepository;

class PasswordGeneratorService
{
    /**
     * Generiert ein zufälliges Passwort und schreibt es in die Datenbank.
     *
     * @param Account $account Der Account, der ein neues Passwort benötigt
     * @return string
     */
    public static function generatePassword(Account $account): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_.,;:-+-*/=?<>!§$%&()}{][]|';
        $length = 20;
        $generatedPassword = '';
        for ($i = 0; $i < $length; $i++) {
            $generatedPassword .= $characters[mt_rand(0, strlen($characters) - 1)];
        };

        AccountRepository::updatePassword($generatedPassword, $account->username);
        return $generatedPassword;
    }

}
