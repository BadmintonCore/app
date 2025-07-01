<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Service;

use Vestis\Exception\ValidationException;
use Vestis\Utility\Base64Utility;

/**
 * Service, der JSON-Web-Token verarbeitet
 * Einführung in JWT: https://jwt.io/introduction
 */
class JWTService
{
    /**
     * Der Standard-Header eines jeden JWT
     */
    private const JWT_HEADER = ['typ' => 'JWT', 'alg' => 'HS256'];

    /**
     * Der secret key, der für die Signatur der JWTs verwendet wird
     */
    private static ?string $secretKey = null;

    /**
     * Erzeugt ein JWT aus der gegebenen payload
     *
     * @param array<string, mixed> $payload Payload, die genutzt werden soll
     * @return string Der finale JWT-String
     * @throws ValidationException
     */
    public static function generateJWT(array $payload): string
    {
        self::loadSecretKey();

        // Header kodiert als base64 (JSON-Daten)
        /** @phpstan-ignore-next-line */
        $base64UrlHeader = Base64Utility::base64UrlEncode(json_encode(self::JWT_HEADER));

        // payload kodiert als base64 (JSON-Daten)
        $jsonEncodedPayload = json_encode($payload);
        if (false === $jsonEncodedPayload) {
            throw new ValidationException('Ungültiger JSON payload.');
        }
        $base64UrlPayload = Base64Utility::base64UrlEncode($jsonEncodedPayload);

        // Die Signatur, die später zur Überprüfung der Gültigkeit des JWT verwendet wird
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secretKey ?? "secret", true);

        // Signatur als base64 string
        $base64UrlSignature = Base64Utility::base64UrlEncode($signature);

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    /**
     * Überprüft das JSON-Web-Token
     *
     * @param string $jwt Das JSON web token
     * @return array<string, mixed>
     * @throws ValidationException
     */
    public static function verifyJWT(string $jwt): array
    {
        self::loadSecretKey();
        // Zerlegt das JWT in seine drei Teile
        $parts = explode('.', $jwt);

        if (count($parts) !== 3) {
            throw new ValidationException("Das JWT besteht nicht aus 3 Teilen. Daher ist es ungültig.");
        }

        // Elemente aus Array "parts" erstellen
        list($headerB64, $payloadB64, $signatureB64) = $parts;

        // Berechnet die erwartete Signatur anhand der im JWT-String angegebenen Header und Payloads
        $expectedSignature = Base64Utility::base64UrlEncode(
            hash_hmac('sha256', "$headerB64.$payloadB64", self::$secretKey ?? "secret", true)
        );

        // Prüft, ob die Signaturen gleich sind. Ist dies nicht der Fall, wurde das JWT auf der Client-Seite geändert.
        // HINWEIS: Wir verwenden hier hash_equals, weil es sicher gegen Timing-Angriffe ist. strcmp ist bei langen Strings möglicherweise nicht 100% genau. Aber hash_equals ist langsamer
        if (!hash_equals($expectedSignature, $signatureB64)) {
            throw new ValidationException("Das JWT stimmt nicht mit der erwarteten Signatur überein.");
        }

        /** @var array<string|mixed>|null $payloadJson */
        $payloadJson = json_decode(Base64Utility::base64UrlDecode($payloadB64), true);
        if (null === $payloadJson) {
            throw new ValidationException("Das JWT enthält keinen gültigen Payload.");
        }
        return $payloadJson;
    }

    /**
     * Lädt den secret key in das statische Attribut
     *
     * @return void
     * @throws ValidationException Wenn JWT_Secret nicht existiert
     */
    private static function loadSecretKey(): void
    {
        if (self::$secretKey === null) {
            $contents = file_get_contents("../conf/JWT_SECRET");
            if (false === $contents) {
                throw new ValidationException("Das JWT_SECRET ist nicht vorhanden.");
            }
            self::$secretKey = $contents;
        }
    }
}
