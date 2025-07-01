<?php
/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
?>
<?php

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Order;
use Vestis\Utility\PaginationUtility;

/** @var PaginationDto<Order> $orders */
/** @var int $page */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Aufträge</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>


    <h1>Aufträge</h1>
    <table class="mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Account</th>
            <th>Zeitpunkt</th>
            <th>Status</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders->results as $order): ?>
            <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->getAccount()->username ?></td>
                <td><?= $order->timestamp->format('d.m.Y h:i:s') ?></td>
                <td><?= $order->status->value ?></td>
                <td>
                    <a href="/admin/orders/view?id=<?= $order->id ?>" class="btn btn-sm">View.</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    PaginationUtility::generatePagination($orders->count, 25, $page);
?>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>