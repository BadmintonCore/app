<?php

namespace Vestis\Service;

use Vestis\Database\Repositories\QueryAbstraction;
use Vestis\Exception\LogicException;

/**
Dienst zum Berechnen des Rabatts für Bestellungen
 */
class OrderService
{
    /**
     * Berechnet den Rabatt für eine Bestellung basierend auf der Bestellnummer
     *
     * @param int $orderNumber Die Bestellnumer, die die Anzahl der bisherigen Bestellungen repräsentiert
     * @return float Der berechnete Rabatt (in Prozent, je nach Bestellnummer)
     */
public function applyDiscount(int $orderId, int $accountId):void
{
    $account = \Vestis\Database\Repositories\AccountRepository::findById($accountId);
    $orderCount = $account->getOrderCountByAccount();
    $discount = $this->calculateDiscount($orderCount + 1, $orderId);
    $query = "UPDATE orders SET discount = :discount WHERE id = :orderId";
    QueryAbstraction::execute($query, ['discount' => $discount, 'orderId' => $orderId]);

}
    function calculateDiscount(int $orderNumber, int $orderId): float
    {
        $discount = 0.0;
        $message = "";

        if ($orderNumber % 20 === 0) {
           $discount = 0.2; // 20% Rabatt
        } elseif ($orderNumber % 10 === 0) {
            $discount = 0.1; // 10% Rabatt
        }

        if($discount >0.0) {
            $message = "Herzlichen Glückwunsch! Sie haben einen Rabatt von " . ($discount * 100) . "% auf Ihre Bestellung erhalten.";
        } else {
            $message = "Vielen Dank für Ihre Bestellung!";
        }

        $this->saveDiscount($orderId, $discount, $message);

        return $discount; // errechneter Rabatt in Prozent (0%, 10% oder 20%)
    }

    public function saveDiscount(int $orderId, float $discount, string $message): void
    {
        $query = "UPDATE orders SET discount = :discount, discountMessage = :message WHERE id = :orderId";
        QueryAbstraction::execute($query, [
            'discount' => $discount,
            'message' => $message,
            'orderId' => $orderId,
        ]);
    }


}