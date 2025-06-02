<?php

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
