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

/**
 * Bereich für deinen Einkauf
 */
class YourPurchaseController
{
    public function root(): void
    {
        header('Location: /');
    }

    /**
     * Ansicht für die Bestellinformationen
     *
     * @return void
     */
    public function order(): void
    {
        require_once __DIR__.'/../views/your-purchase/order.php';
    }

    /**
     * Ansicht für die Zahlungsmethoden
     *
     * @return void
     */
    public function paymentMethods(): void
    {
        require_once __DIR__.'/../views/your-purchase/paymentmethods.php';
    }

    /**
     * Ansicht für die Lieferungen
     *
     * @return void
     */
    public function shipment(): void
    {
        require_once __DIR__.'/../views/your-purchase/shipment.php';
    }

    /**
     * Ansicht für Online-Gutscheine
     *
     * @return void
     */
    public function vouchers(): void
    {
        require_once __DIR__.'/../views/your-purchase/vouchers.php';
    }
}
