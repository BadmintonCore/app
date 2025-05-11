<?php

namespace Vestis\Controller;

class YourPurchaseController
{
    public function order(): void
    {
        require_once __DIR__.'/../views/your-purchase/order.php';
    }

    public function paymentMethods(): void
    {
        require_once __DIR__.'/../views/your-purchase/paymentmethods.php';
    }

    public function shipment(): void
    {
        require_once __DIR__.'/../views/your-purchase/shipment.php';
    }

    public function vouchers(): void
    {
        require_once __DIR__.'/../views/your-purchase/vouchers.php';
    }
}
