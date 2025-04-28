<!-- Author: Mathis Burger -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Vestis - Warenkorb</title>
    <meta name="keywords" content="clothing, fashion, kleidung">
    <!--Reference to mystyle.css-->
    <link rel="stylesheet" type="text/css" href="mystyle.css">

    <!--vestis.-Logo in Browser-Tab-->
    <link rel="shortcut icon" href="/img/logo.png" />
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