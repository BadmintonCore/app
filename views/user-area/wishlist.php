<!-- Autor(en): Lasse Hoffmann -->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__ . "/../../components/head.php"); ?>
    <title>Vestis - Wunschliste</title>
</head>
<body>
<?php include(__DIR__ . "/../../components/header.php"); ?>
<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__ . "/../../components/breadcrumbs.php"); ?>

    <!--Zurückbutton-->
    <?php include(__DIR__ . "/../../components/back-btn.php"); ?>
    <div class="stack">
        <h1>Wunschliste</h1>

        <table style="text-align: center">
            <thead>
            <tr>
                <th>Produkt</th>
                <th>Preis</th>
                <th>Hinzugefügt am</th>
                <th>Zum Produkt</th>
                <th>Entfernen</th>
            </tr>
            </thead>
            <tbody id="WishlistTBody">
            </tbody>
        </table>
    </div>
</main>
<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__ . "/../../components/cookieCheck.php"); ?>
<?php include(__DIR__ . "/../../components/scripts.php"); ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        renderWishlist();
    })
</script>
</body>
</html>
<!-- Autor(en): Lasse Hoffmann -->