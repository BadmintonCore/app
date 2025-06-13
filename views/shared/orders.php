<?php

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Order;
use Vestis\Database\Models\OrderStatus;
use Vestis\Service\AuthService;
use Vestis\Utility\PaginationUtility;

/** @var PaginationDto<Order> $orders */
/** @var int $page */
?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Aufträge</title>
    <?php include(__DIR__."/../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->


<?php
    if (AuthService::isAdmin()) {
        include(__DIR__."/../../components/adminHeader.php");
    } else {
        include(__DIR__."/../../components/header.php");
    }
?>

<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>


    <h1>Aufträge</h1>

    <?php if (AuthService::isAdmin()):?>
    <div class="button-row">
        <?php foreach (OrderStatus::cases() as $status): ?>
        <a href="/admin/orders?status=<?= $status->value ?>" class="btn btn-sm <?= $_GET['status'] !== $status->value ? 'secondary' : '' ?>"><?= $status->value ?></a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <table class="mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <?php if (AuthService::isAdmin()): ?>
            <th>Account</th>
            <?php endif; ?>
            <th>Zeitpunkt</th>
            <th>Status</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders->results as $order): ?>
            <tr>
                <td><?= $order->id ?></td>
                <?php if (AuthService::isAdmin()): ?>
                <td><?= $order->getAccount()->username ?></td>
                <?php endif; ?>
                <td><?= $order->timestamp->format('d.m.Y h:i:s') ?></td>
                <td><?= $order->status->value ?></td>
                <td>
                    <?php if (AuthService::isAdmin()): ?>
                    <a href="/admin/orders/view?id=<?= $order->id ?>" class="btn btn-sm">View.</a>
                    <?php else: ?>
                    <a href="/user-area/orders/view?id=<?= $order->id ?>" class="btn btn-sm">View.</a>
                    <?php endif; ?>
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
<?php
if (AuthService::isAdmin()) {
    include(__DIR__."/../../components/adminFooter.php");
} else {
    include(__DIR__ . "/../../components/footer.php");
}
?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

