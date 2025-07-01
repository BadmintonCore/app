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

use Vestis\Database\Models\Account;
use Vestis\Database\Repositories\OrderRepository;

/**
Dienst zum Berechnen des Rabatts für Bestellungen
 */
class DiscountService
{
    /**
     * Berechnet den Rabatt für eine Bestellung basierend auf der Bestellnummer
     *
     * @param int $orderId
     * @param Account $account Der Account, dem die Bestellung gehört.
     * @return void Der berechnete Rabatt (in Prozent, je nach Bestellnummer)
     */
    public static function applyDiscount(int $orderId, Account $account): void
    {
        $orderCount = OrderRepository::getCountOfOrdersForAccount($account);
        self::calculateAndSaveDiscount($orderCount + 1, $orderId);
    }

    /**
     * Berechnet die Rabatthöhe
     *
     * @param int $orderNumber Die Anzahl an Bestellungen
     * @param int $orderId Die ID der aktuellen Bestellung
     */
    private static function calculateAndSaveDiscount(int $orderNumber, int $orderId): void
    {
        $discount = 0.0;
        $message = "";

        if ($orderNumber % 20 === 0) {
            $discount = 0.2; // 20% Rabatt
        } elseif ($orderNumber % 10 === 0) {
            $discount = 0.1; // 10% Rabatt
        }

        if ($discount > 0.0) {
            $message = "Herzlichen Glückwunsch! Sie haben einen Rabatt von " . ($discount * 100) . "% auf Ihre Bestellung erhalten.";
        } else {
            $message = "Vielen Dank für Ihre Bestellung!";
        }

        OrderRepository::saveDiscount($orderId, $discount, $message);
    }

}
