<?php

namespace Vestis\Utility;

use Vestis\Exception\ValidationException;

class Base64Utility
{

    /**
     * Encodes string as base64, but the URL safe version
     *
     * @param string $data The input data
     * @return string The encoded string
     */
    public static function base64UrlEncode(string $data): string
    {
        // rtrim removes all '=' characters at the end of the string in order to get the base54 url encoded string
        // strtr replaces '+' by '-' and '/' by '_'. This is needed because '+' and '/' are characters with a specific meaning in a URI. Therefore, without replacing
        // them in the string the base64 string would be not URI safe.
        // We use strtr here over str_replace because it provides higher performance in the case of character by character replacements
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Decodes a base64 url encoded string to a normal string
     *
     * @param string $data The url encoded base64 string
     * @return string The normal string
     * @throws ValidationException
     */
    public static function base64UrlDecode(string $data): string
    {
        $result = base64_decode(strtr($data, '-_', '+/'), true);
        if ($result === false) {
            throw new ValidationException("Cannot decode base64.");
        }
        return $result;
    }
}