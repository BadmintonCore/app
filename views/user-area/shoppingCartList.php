<?php

use Vestis\Database\Models\ShoppingCart;

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
                        <td><a href="/user-area/shoppingCart?accId=<?= $ownedShoppingCart->accId ?>&cartNumber=<?= $ownedShoppingCart->cartNumber ?>" class="btn btn-sm">Öffnen.</a></td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        renderWishlist();
    })
</script>
</body>
</html>
<!-- Author: Mathis Burger -->