<!--Author: Lennart Moog-->
<?php

use Vestis\Database\Models\Order;
use Vestis\Database\Models\OrderStatus;
use Vestis\Service\AuthService;

/** @var Order $order */

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Auftrag</title>
    <?php include(__DIR__."/../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <div class="form-box">
        <h1>Auftrag (ID: <?= $order->id ?>)</h1>

        <div class="stack align-start">
            <h3 class="m-0">Datum: <?= $order->timestamp->format('d.m.Y h:i:s') ?></h3>
            <h3 class="m-0">Status: <?= $order->status->value ?></h3>
            <?php if ($order->denialMessage !== null): ?>
                <h3 class="m-0">Grund: <?= $order->denialMessage ?></h3>
            <?php endif; ?>
        </div>

        <div class="button-row justify-center mt-4">
            <?php if (AuthService::isCustomer() && !in_array($order->status, [OrderStatus::Canceled, OrderStatus::Denied, OrderStatus::Shipped], true)): ?>
            <a class="btn btn-sm" href="/user-area/orders/cancel?id=<?= $order->id ?>">Stornieren</a>
            <?php endif; ?>
            <?php if (AuthService::isAdmin() && in_array($order->status, [OrderStatus::PaymentPending, OrderStatus::InProgress], true)): ?>
                <a class="btn btn-sm" href="/admin/orders/deny?id=<?= $order->id ?>">Ablehnen</a>
            <?php endif; ?>
            <?php if (AuthService::isAdmin() && $order->status === OrderStatus::PaymentPending): ?>
                <a class="btn btn-sm" href="/admin/orders/confirmPayment?id=<?= $order->id ?>">Zahlung bestätigen</a>
            <?php endif; ?>
            <?php if (AuthService::isAdmin() && $order->status === OrderStatus::InProgress): ?>
                <a class="btn btn-sm" href="/admin/orders/confirmShipment?id=<?= $order->id ?>">Versand bestätigen</a>
            <?php endif; ?>
        </div>

        <table class="mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Größe</th>
                    <th>Farbe</th>
                    <th>Kaufpreis</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order->getProducts() as $product): ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->getSize()->size ?></td>
                    <td><?= $product->getColor()->name ?></td>
                    <td class="price-field"><?= $product->boughtPrice ?> €</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Summe: <span class="price-field"><?= $order->getOrderSum() ?> €</span></h3>
    </div>


</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

