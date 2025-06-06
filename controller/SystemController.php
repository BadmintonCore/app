<?php

/*Autor(en): */

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
/*Autor(en): */
