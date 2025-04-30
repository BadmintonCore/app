<!-- Author: Mathis Burger -->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("../components/head.php"); ?>
    <title>Vestis - Warenkorb</title>
</head>
<body>
    <?php include("../components/header.php"); ?>
    <main>
        <?php include("../components/back-btn.php"); ?>
        <div class="stack">
            <h1>Warenkorb</h1>

            <table>
                <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Anzahl</th>
                    <th>Preis</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody id="shoppingCartTBody">
                </tbody>
            </table>
            <strong id="priceWOTax"></strong>
            <strong id="priceWITax"></strong>
            <button type="submit" class="btn">Zur Kasse</button>
        </div>
    </main>
    <?php include("../components/footer.php"); ?>

<script src="/js/shoppingCart.js"></script>
<script>
    renderShoppingCart();
</script>
</body>
</html>
<!-- Author: Mathis Burger -->