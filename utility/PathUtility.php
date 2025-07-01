<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Utility;

class PathUtility
{
    /**
     * Gibt den aktuellen Pfad zurück
     *
     * @return string
     */
    public static function getPathname(): string
    {
        /** @var string $requestUri */
        $requestUri = $_SERVER['REQUEST_URI'] ?? "/";
        return explode("?", $requestUri)[0];
    }

}
