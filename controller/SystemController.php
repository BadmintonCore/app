<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Vestis\Controller;

use Vestis\Exception\LogicException;
use Vestis\Service\CacheService;

/**
 * Controller für system-native Funktionen, die keiner anderen Domäne zugeordnet werden können
 */
class SystemController
{
    /**
     * Gibt die Exchange Rates als JSON zurück
     *
     * @throws LogicException
     * @return void
     */
    public function getExchangeRates(): void
    {
        $content = CacheService::get('exchangeRates');
        if ($content === null) {
            // Liest die Daten von der API aus
            $content = file_get_contents('https://api.frankfurter.app/latest?from=EUR&to=USD,CHF');
            if ($content === false) {
                throw new LogicException("Unable to load exchange rates");
            }
            CacheService::set('exchangeRates', $content);
        }
        header('Content-Type: application/json');
        echo $content;
    }

}
