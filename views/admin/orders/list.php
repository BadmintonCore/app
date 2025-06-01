<?php

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Order;
use Vestis\Utility\PaginationUtility;

/** @var PaginationDto<Order> $orders */
/** @var int $page */
?>

<!--Author: Lennart Moog-->
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
<!--Author: Lennart Moog -->

