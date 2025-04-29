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
    <div class="list-page-flex">
        <div class="card no-hover">
            <div class="filter-options">
                <div class="option-box-with-title can-grow">
                    <strong class="align-start">Suchen</strong>
                    <input type="text" placeholder="Suche...">
                </div>
                <div class="option-box-with-title">
                    <strong class="align-start">Farben</strong>
                    <div class="flex-row">
                        <label><input type="checkbox"> Grün</label>
                        <label><input type="checkbox"> Blau</label>
                        <label><input type="checkbox"> Schwarz</label>
                        <label><input type="checkbox"> Pink</label>
                    </div>
                </div>
                <div class="option-box-with-title">
                    <strong class="align-start">Größe</strong>
                    <div class="flex-row">
                        <label><input type="radio" value="xs" name="size"> XS</label>
                        <label><input type="radio" value="s" name="size"> S</label>
                        <label><input type="radio" value="m" name="size"> M</label>
                        <label><input type="radio" value="l" name="size"> L</label>
                        <label><input type="radio" value="xl" name="size"> XL</label>
                    </div>
                </div>
                <div class="option-box-with-title">
                    <strong class="align-start">Preis</strong>
                    <input type="range">
                </div>
                <button class="btn btn-sm">
                    filtern.
                </button>
            </div>
        </div>
        <div class="card-flex">
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