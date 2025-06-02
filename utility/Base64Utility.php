<?php

namespace Vestis\Utility;

use Vestis\Exception\ValidationException;

class Base64Utility
{
    /**
     * Kodiert String als base64, aber die URL-sichere Version
     *
     * @param string $data Die Eingabedaten
     * @return string Die kodierte Zeichenfolge
     */
    public static function base64UrlEncode(string $data): string
    {
        // rtrim entfernt alle '='-Zeichen am Ende der Zeichenfolge, um die base54-URL-kodierte Zeichenfolge zu erhalten
        // strtr ersetzt '+' durch '-' und '/' durch '_'. Dies ist erforderlich, weil „+“ und „/“ Zeichen mit einer bestimmten Bedeutung in einem URI sind. Ohne ihre Ersetzung
        // in der Zeichenkette wäre die base64-Zeichenkette daher nicht URI-sicher.
        // Wir verwenden hier strtr anstelle von str_replace, weil es bei zeichenweiser Ersetzung mehr Leistung bietet
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Dekodiert eine base64 url kodierte Zeichenkette in eine normale Zeichenkette
     *
     * @param string $data Der url kodierte base64 String
     * @return string Der normale String
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
