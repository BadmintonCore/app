<?php

namespace Vestis\Utility;

use Random\RandomException;

class GeneratorUtility
{

    /**
     * Generates a secret
     *
     * @param int $length The length of the secret
     * @return string
     */
    public static function generateSecret(int $length = 255): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';

        $generatedPassword = '';

        try {
            for ($i = 0; $i < $length; $i++) {
                $generatedPassword .= $characters[random_int(0, strlen($characters) - 1)];
            };
            return $generatedPassword;
        } catch (RandomException $e) {
            return '';
        }
    }

}