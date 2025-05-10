<?php

namespace Vestis\Service;

use Vestis\Exception\ValidationException;

/**
 * Service that handles JSON web tokens
 * Introduction to JWT: https://jwt.io/introduction
 */
class JWTService
{
    /**
     * The default header of every JWT
     */
    private const array JWT_HEADER = ['typ' => 'JWT', 'alg' => 'HS256'];

    /**
     * The secret key used for the JWTs signature
     */
    private static ?string $secretKey = null;

    /**
     * Generates a JWT from the given payload
     *
     * @param array<string, mixed> $payload The payload that should be used
     * @return string The final JWT string
     * @throws ValidationException
     */
    public static function generateJWT(array $payload): string
    {
        self::loadSecretKey();

        // Header encoded as base64 (JSON data)
        /** @phpstan-ignore-next-line */
        $base64UrlHeader = self::base64UrlEncode(json_encode(self::JWT_HEADER));

        // payload encoded as base64 (JSON data)
        $jsonEncodedPayload = json_encode($payload);
        if (false === $jsonEncodedPayload) {
            throw new ValidationException('Invalid JSON payload');
        }
        $base64UrlPayload = self::base64UrlEncode($jsonEncodedPayload);

        // The signature that is later used to verify the JWT is valid.
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secretKey ?? "secret", true);

        // Signature as base64 string
        $base64UrlSignature = self::base64UrlEncode($signature);

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    /**
     * Verifies the JSON web token
     *
     * @param string $jwt The JSON web token
     * @return array<string, mixed>
     * @throws ValidationException
     */
    public static function verifyJWT(string $jwt): array
    {
        self::loadSecretKey();
        // Splits the JWT into its three parts
        $parts = explode('.', $jwt);

        if (count($parts) !== 3) {
            throw new ValidationException("The JWT does not have 3 parts. Therefore, it is invalid");
        }

        list($headerB64, $payloadB64, $signatureB64) = $parts;

        // Calculates the expected signature by the header and payload given in the JWT string
        $expectedSignature = self::base64UrlEncode(
            hash_hmac('sha256', "$headerB64.$payloadB64", self::$secretKey ?? "secret", true)
        );

        // Checks whether the signatures are equal. If they are not, the JWT got modified on the client side.
        // NOTE: We use hash_equals here, because it is safe against timing attacks. strcmp might not be 100% accurate with long strings. But hash_equals is slower
        if (!hash_equals($expectedSignature, $signatureB64)) {
            throw new ValidationException("The JWT does not match the expected signature.");
        }

        /** @var array<string|mixed>|null $payloadJson */
        $payloadJson = json_decode(self::base64UrlDecode($payloadB64), true);
        if (null === $payloadJson) {
            throw new ValidationException("The JWT does not contain a valid payload.");
        }
        return $payloadJson;
    }

    /**
     * Encodes string as base64, but the URL safe version
     *
     * @param string $data The input data
     * @return string The encoded string
     */
    private static function base64UrlEncode(string $data): string
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
    private static function base64UrlDecode(string $data): string
    {
        $result = base64_decode(strtr($data, '-_', '+/'), true);
        if ($result === false) {
            throw new ValidationException("Cannot decode base64.");
        }
        return $result;
    }

    /**
     * Loads the secret key into the static attribute.
     *
     * @return void
     * @throws ValidationException On JWT_SECRET not existing
     */
    private static function loadSecretKey(): void
    {
        if (self::$secretKey === null) {
            $contents = file_get_contents("../conf/JWT_SECRET");
            if (false === $contents) {
                throw new ValidationException("The JWT_SECRET does not exist.");
            }
            self::$secretKey = $contents;
        }
    }
}
