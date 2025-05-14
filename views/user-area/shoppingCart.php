<!-- Author: Mathis Burger -->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>Vestis - Warenkorb</title>
</head>
<body>
    <?php include(__DIR__."/../../components/header.php"); ?>
    <main>

        <!--Breadcrumbs-->
        <?php include("../components/breadcrumbs.php"); ?>

        <?php include(__DIR__."/../../components/back-btn.php"); ?>
        <div class="stack">
            <h1>Warenkorb</h1>

            <table>
                <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Anzahl</th>
                    <th>Stückpreis</th>
                    <th>Gesamtpreis</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody id="shoppingCartTBody">
                </tbody>
            </table>
            <strong id="priceWOTax"></strong>
            <strong id="priceWITax"></strong>
            <button type="submit" class="btn" id="payButton">Zur Kasse</button>
        </div>
    </main>
    <?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
<script src="/js/shoppingCart.js"></script>
<script>
    renderShoppingCart();
</script>
</body>
</html>
<!-- Author: Mathis Burger -->