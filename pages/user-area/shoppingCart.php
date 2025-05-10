<!-- Author: Mathis Burger -->
<?php

use Vestis\Database\Models\AccountType;
use Vestis\Service\AuthService;

AuthService::checkAccess(AccountType::Customer);
?>
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
    <?php include("../components/footer.php"); ?>
<?php include("../components/scripts.php"); ?>
<script src="/js/shoppingCart.js"></script>
<script>
    renderShoppingCart();
</script>
</body>
</html>
<!-- Author: Mathis Burger -->