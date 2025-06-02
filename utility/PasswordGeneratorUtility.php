<?php

//Author: Lasse Hoffmann

namespace Vestis\Utility;

use Random\RandomException;
use Vestis\Database\Models\Account;
use Vestis\Service\AccountService;

class PasswordGeneratorUtility
{
    /**
     * Generiert ein zufälliges Passwort und schreibt es in die Datenbank
     *
     * @param Account $account Der Account, der ein neues Passwort benötigt
     * @return string
     */
    public static function generatePassword(Account $account): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_.-+-*/=?<>!(){}[]';
        $length = 20;

        $generatedPassword = '';

        try {
            for ($i = 0; $i < $length; $i++) {
                $generatedPassword .= $characters[random_int(0, strlen($characters) - 1)];
            };
        } catch (RandomException $e) {
            for ($j = 0; $j < $length; $j++) {
                $generatedPassword .= $characters[mt_rand(0, strlen($characters) - 1)];
            };
        }
        AccountService::resetPassword($generatedPassword, $account);
        return $generatedPassword;
    }

}
