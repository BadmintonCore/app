<?php

use Vestis\Database\Models\ShoppingCart;
use Vestis\Service\AuthService;

/** @var ShoppingCart[] $ownedShoppingCarts */

?>
<!-- Author: Mathis Burger-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>Vestis - Warenkörbe</title>
</head>
<body>
<?php include(__DIR__."/../../components/header.php"); ?>
<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <!--Zurückbutton-->
    <?php include(__DIR__."/../../components/back-btn.php"); ?>
    <div class="stack">
        <h1>Warenkörbe</h1>

        <a href="/user-area/shoppingCarts/create" class="btn btn-sm">Erstellen.</a>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Besitzer</th>
                <th>Name</th>
                <th>Geteilt?</th>
                <th>Aktionen</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($ownedShoppingCarts as $ownedShoppingCart): ?>
                    <tr>
                        <td><?= $ownedShoppingCart->cartNumber ?></td>
                        <td><?= $ownedShoppingCart->getAccount()->username ?></td>
                        <td><?= $ownedShoppingCart->name ?? "Standard" ?></td>
                        <td><?= $ownedShoppingCart->isShared ? "Ja" : "Nein" ?></td>
                        <td>
                            <div class="button-row">
                                <a href="/user-area/shoppingCart?accId=<?= $ownedShoppingCart->accId ?>&cartNumber=<?= $ownedShoppingCart->cartNumber ?>" class="btn btn-sm">Öffnen.</a>
                                <?php if ($ownedShoppingCart->cartNumber !== 1 && $ownedShoppingCart->accId === AuthService::$currentAccount?->id): ?>
                                    <a href="/user-area/shoppingCarts/delete?cartNumber=<?= $ownedShoppingCart->cartNumber ?>" class="btn btn-sm danger">Delete.</a>
                                <?php endif; ?>
                            </div>
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
<!-- Author: Mathis Burger -->