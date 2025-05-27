<!-- Author: Mathis Burger -->
<?php

use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Category;

/** @var array<int, ProductType> $products */
/** @var Category|null $category */
/** @var string|null $errorMessage */

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>Vestis - <?= $category?->name ?? "Unbekannt" ?></title>
</head>
<body>
<?php include(__DIR__."/../../components/header.php"); ?>
<main class="content-wide">

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <!-- Funktion beim Laden der Seite automatisch aufrufen -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            generateBreadcrumbList();
        });
    </script>

    <?php if ($category && $errorMessage === null): ?>
    <h1><?= $category->name ?></h1>
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
            <?php foreach ($products as $product) : ?>
                <div class="card product-card">
                    <img
                            src="/img/tshirt-beige.webp"
                            alt="product image"/>
                    <br>
                    <h2><a href="<?= sprintf("/categories/product?itemId=%s&categoryId=%s&categoryName=%s", $product->id, $product->categoryId, $category->name) ?>"><?= $product->name ?></a></h2>
                    <h4 class="price-field"><?= $product->price ?></h4>
                    <a href="<?= sprintf("/categories/product?itemId=%s&categoryId=%s&categoryName=%s", $product->id, $category->id, $category->name) ?>" class="btn btn-sm">details.</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php else: ?>
    <h1><?= $errorMessage ?></h1>
    <?php endif; ?>


</main>

<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!-- Author: Mathis Burger -->