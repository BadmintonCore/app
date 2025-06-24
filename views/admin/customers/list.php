<!--Autor(en): Lennart Moog-->
<?php

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Account;

/** @var PaginationDto<Account> $customers */
/** @var int $page */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Kunden</title>
    <?php include(__DIR__ . "/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__ . "/../../../components/adminHeader.php"); ?>

<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Breadcrumbs-->
    <?php include(__DIR__ . "/../../../components/breadcrumbs.php"); ?>

    <h1>Kunden</h1>
    <table class="mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Benutzername</th>
            <th>Email</th>
            <th>Gesperrt?</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($customers->results as $customer): ?>
            <tr>
                <td><?= $customer->id ?></td>
                <td><?= $customer->firstname ?></td>
                <td><?= $customer->surname ?></td>
                <td><?= $customer->username ?></td>
                <td><?= $customer->email ?></td>
                <td><?= $customer->isBlocked ? 'Ja' : 'Nein' ?></td>
                <td>
                    <a class="btn btn-sm danger" href="/admin/customers/toggleBlock?id=<?= $customer->id ?>">
                        <?php if ($customer->isBlocked): ?>
                            Entblockieren
                        <?php else: ?>
                            Blockieren
                        <?php endif; ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    \Vestis\Utility\PaginationUtility::generatePagination($customers->count, 25, $page);
?>
</main>

<!--Footer der Website-->
<?php include(__DIR__ . "/../../../components/adminFooter.php"); ?>
<?php include(__DIR__ . "/../../../components/scripts.php"); ?>
</body>
</html>
<!--Autor(en): Lennart Moog-->