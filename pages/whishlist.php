<!-- Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("../components/head.php"); ?>
    <title>Vestis - Wunschliste</title>
</head>
<body>
<?php include("../components/header.php"); ?>
<main>
    <?php include("../components/back-btn.php"); ?>
    <div class="stack">
        <h1>Wunschliste</h1>

        <table>
            <thead>
            <tr>
                <th>Produkt</th>
                <th>Preis</th>
                <th>Hinzugefügt am</th>
                <th>In den Warenkorb</th>
                <th>Entfernen</th>
            </tr>
            </thead>
            <tbody id="WishlistTBody">
            </tbody>
        </table>
    </div>
</main>
<?php include("../components/footer.php"); ?>
<?php include("../components/scripts.php"); ?>
<script src="/js/wishlist.js"></script>
<script>
    renderWishlist();
</script>
</body>
</html>
<!-- Author: Lasse Hoffmann -->