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

use Vestis\Database\Models\ShoppingCart;

/** @var ShoppingCart $shoppingCart */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>Vestis - Warenkörbe</title>
</head>
<body>
<?php include(__DIR__."/../../components/header.php"); ?>
<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>


    <div class="stack">
        <h1>Mitglieder von <?= $shoppingCart->name ?? "Standard" ?></h1>
        <div class="button-row">
            <?php if ($shoppingCart->isShared): ?>
                <button
                    class="btn btn-sm"
                    id="inviteButton"
                    accId="<?= $shoppingCart->accId ?>"
                    cartNumber="<?= $shoppingCart->cartNumber ?>"
                    inviteSecret="<?= $shoppingCart->inviteSecret ?>"
                >Einladungslink kopieren.</button>
            <?php endif; ?>
        </div>
        <table>
            <thead>
            <tr>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Benutzername</th>
                <th>Aktionen</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($shoppingCart->getMembers() as $member): ?>
                <tr>
                    <td><?= $member->firstname ?></td>
                    <td><?= $member->surname ?></td>
                    <td><?= $member->username ?></td>
                    <td>
                        <a class="btn btn-sm danger" href="/user-area/shoppingCarts/members/remove?userId=<?= $member->id ?>&accId=<?= $shoppingCart->accId ?>&cartNumber=<?= $shoppingCart->cartNumber ?>">Entfernen.</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>