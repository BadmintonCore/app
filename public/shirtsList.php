<!-- Author: Mathis Burger -->
<?php require_once("../components/product-card.php"); ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Vestis - Kategorie 1</title>
    <meta name="keywords" content="clothing, fashion, kleidung">
    <!--Reference to mystyle.css-->
    <link rel="stylesheet" type="text/css" href="mystyle.css">

    <!--vestis.-Logo in Browser-Tab-->
    <link rel="shortcut icon" href="/img/logo.png" />
</head>
<body>
<?php include("../components/header.php"); ?>
<main class="content-wide">
    <h1>Übersicht - Tshirts</h1>
    <div class="grid-20-80">
        <div class="card no-hover justify-start gap-3">
            <h3>Filter Optionen</h3>
            <div class="align-start">
                <strong>Suchen</strong>
                <input type="text" placeholder="Suche...">
            </div>
            <div class="align-start">
                <strong>Farben</strong>
                <label><input type="checkbox"> Grün</label>
                <label><input type="checkbox"> Blau</label>
                <label><input type="checkbox"> Schwarz</label>
                <label><input type="checkbox"> Pink</label>
            </div>
            <div class="align-start">
                <strong>Größe</strong>
                <div class="flex-row">
                    <label><input type="radio" value="xs" name="size"> XS</label>
                    <label><input type="radio" value="s" name="size"> S</label>
                    <label><input type="radio" value="m" name="size"> M</label>
                    <label><input type="radio" value="l" name="size"> L</label>
                    <label><input type="radio" value="xl" name="size"> XL</label>
                </div>
            </div>
            <div class="align-start">
                <strong>Preis</strong>
                <input type="range">
            </div>
            <button class="btn btn-sm align-start">
                filtern.
            </button>
        </div>
        <div class="grid-4-col">
            <?php
                for ($i = 0; $i<8; $i++) {
                    echo generateProjectCard("/img/tshirt-beige.webp", "itemid.php", "Tshirt", 55.00);
                }
            ?>
        </div>
    </div>
</main>

<?php include("../components/footer.php"); ?>
</body>
</html>
<!-- Author: Mathis Burger -->