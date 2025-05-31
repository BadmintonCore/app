<!-- Author: Mathis Burger -->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php use Vestis\Database\Dto\ShoppingCartItemDto;
    use Vestis\Database\Repositories\ShoppingCartRepository;

    /** @var ShoppingCartItemDto[] $groupedProducts */

    include(__DIR__ . "/../../components/head.php"); ?>
    <title>Vestis - Warenkorb</title>
</head>
<body>
<?php include(__DIR__ . "/../../components/header.php"); ?>
<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__ . "/../../components/breadcrumbs.php"); ?>

    <?php include(__DIR__ . "/../../components/back-btn.php"); ?>
    <div class="stack">
        <h1>Warenkorb</h1>

        <table>
            <thead>
            <tr>
                <th>Produkt</th>
                <th>Größe</th>
                <th>Farbe</th>
                <th>Anzahl</th>
                <th>Stückpreis</th>
                <th>Gesamtpreis</th>
                <th>Aktionen</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count($groupedProducts) >= 1): ?>
                <?php foreach ($groupedProducts as $product): ?>
                    <tr>
                        <td><?= $product->getProductType()->name ?></td>
                        <td><?= $product->getSize()->size ?></td>
                        <td><?= $product->getColor()->name ?></td>
                        <td><?= $product->count ?></td>
                        <td><?= "<span class='price-field'>" . number_format($product->getProductType()->price, 2, ',', '.') . "</span>"?></td>
                        <td><?= "<span class='price-field'>" . number_format($product->getProductType()->price * $product->count, 2, ',', '.') . "</span>"?></td>
                        <td>
                            <a href="/user-area/shoppingCart/delete?productTypeId=<?= $product->productTypeId ?>&sizeId=<?= $product->sizeId ?>&colorId=<?= $product->colorId ?>"
                               class="btn danger">Entfernen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center"><b> Dein Warenkorb ist leer. </b></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php

        $price = 0;

    foreach ($groupedProducts as $product):

        $price += $product->getProductType()->price * $product->count;

    endforeach;

    echo "<h4>Gesamtpreis ohne Steuern: <span class='price-field'>" . number_format($price / (1.19), 2, ',', '.') . "</span></h4>";
    echo "<h4>Gesamtpreis (inkl. 19% MwSt.): <span class='price-field'>" . number_format($price, 2, ',', '.') . "</span></h4>";

    ?>
        <button type="submit" class="btn" id="payButton">Zur Kasse</button>
    </div>
</main>
<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__ . "/../../components/scripts.php"); ?>
<script src="/js/shoppingCart.js"></script>
<script>
    renderShoppingCart();
</script>
</body>
</html>
<!-- Author: Mathis Burger -->