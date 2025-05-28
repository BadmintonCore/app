<!-- Author: Mathis Burger -->
<?php

use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Category;
use Vestis\Database\Models\Size;
use Vestis\Utility\BreadcrumbsUtility;

/** @var array<int, ProductType> $products */
/** @var Category|null $category */
/** @var string|null $errorMessage */
/** @var Color[] $colors */
/** @var Size[] $sizes */
/** @var int $minPrice */
/** @var int $maxPrice */
/** @var string|null $search */
/** @var int $maxAllowedPrice */
/** @var array<int, int> $allowedColors */
/** @var array<int, int> $allowedSizes */

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>Vestis - <?= $category->name ?? "Unbekannt" ?></title>
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

    <?php if ($category !== null && $errorMessage === null): ?>
    <h1><?= $category->name ?></h1>
    <div class="list-page-flex">
        <div class="card no-hover">
            <form class="filter-options" id="filterForm">
                <div class="option-box-with-title can-grow">
                    <strong class="align-start">Suchen</strong>
                    <input type="text" placeholder="Suche..." name="search" value="<?= $search ?? '' ?>">
                </div>
                <div class="option-box-with-title">
                    <strong class="align-start">Farben</strong>
                    <div class="flex-row">
                        <?php foreach ($colors as $color): ?>
                        <label>
                            <input
                                    type="checkbox"
                                    style="--accent-color: #<?= $color->hex ?>"
                                    value="<?= $color->id ?>"
                                    name="color_<?= $color->id ?>"
                                    <?= in_array($color->id, $allowedColors, true) ? "checked" : "" ?>
                            >
                            <?= $color->name ?>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="option-box-with-title">
                    <strong class="align-start">Größe</strong>
                    <div class="flex-row">
                        <?php foreach ($sizes as $size): ?>
                        <label>
                            <input
                                    type="checkbox"
                                    class="checkbox"
                                    value="<?= $size->id ?>"
                                    name="size_<?= $size->id ?>"
                                <?= in_array($size->id, $allowedSizes, true) ? "checked" : "" ?>
                            >
                            <?= $size->size ?>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="option-box-with-title">
                    <strong class="align-start">Preis</strong>
                    <div class="flex-row">
                        <span class="price-field"><?= $minPrice ?>€</span>
                        <input type="range" min="<?= $minPrice ?>" max="<?= $maxPrice ?>" value="<?= $maxAllowedPrice ?>" name="price">
                        <span class="price-field"><?= $maxPrice ?>€</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm">
                    filtern.
                </button>
            </form>
        </div>
        <div class="card-flex">
            <?php foreach ($products as $product) : ?>
                <?php

                    $uri = sprintf(
                        "/categories/product?itemId=%s&%s=%s",
                        $product->id,
                        BreadcrumbsUtility::FIELD_NAME,
                        BreadcrumbsUtility::generateProductBreadcrumbsBase64($category, $product)
                    );
                ?>
                <div class="card product-card">
                    <img
                            src="/img/tshirt-beige.webp"
                            alt="product image"/>
                    <br>
                    <h2><a href="<?= $uri ?>"><?= $product->name ?></a></h2>
                    <h4 class="price-field"><?= $product->price ?></h4>
                    <a href="<?= $uri ?>" class="btn btn-sm">details.</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php else: ?>
    <h1><?= $errorMessage ?></h1>
    <?php endif; ?>


</main>

<script>
    const form = document.getElementById('filterForm');

    // Ersetzt alle URL Params aus dem Formular und kombiniert diese mit der bestehenden Kategorie-ID und dem Content für die Breadcrumbs
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const url = new URL(window.location.href);
        const existingParams = url.searchParams;

        const newSearchParams = new URLSearchParams();
        const formData = new FormData(form);
        for (const [key, value] of formData) {
            newSearchParams.set(key, value);
        }

        newSearchParams.set('categoryId', existingParams.get('categoryId'));
        newSearchParams.set('breadcrumpsContent', existingParams.get('breadcrumpsContent'));

        window.location.href = url.pathname + '?' + newSearchParams.toString();
    });
</script>

<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!-- Author: Mathis Burger -->