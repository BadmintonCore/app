<?php

use Vestis\Database\Models\Category;
use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Size;

/** @var ProductType|null $productType */
/** @var Category[] $optionalCategories */
/** @var Size[] $optionalSizes */
/** @var Color[] $optionalColors */
/** @var string|null $errorMessage */
?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Produkt Typen</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>

    <?php if ($productType !== null) : ?>
    <h1><?= $productType->name ?></h1>
    <form method="post" class="form-box">
        <?php if (isset($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage ?></div>
        <?php endif; ?>
        <div class="button-row justify-center">
            <a href="/admin/productTypes/assignImages?id=<?= $productType->id ?>" class="btn btn-sm">Bilder zuweisen</a>
            <a href="/admin/productTypes/instances?id=<?= $productType->id ?>" class="btn btn-sm">Produkt Instanzen</a>
        </div>
        <div class="form-input">
            <label for="name">Name</label>
            <input name="name" value="<?= $productType->name ?>" id="name" required />
        </div>
        <div class="form-input">
            <label for="categoryId">Kategorie</label>
            <select name="categoryId" id="categoryId" required>
                <?php foreach ($optionalCategories as $category): ?>
                    <option value="<?= $category->id ?>" <?= ($category->id === $productType->categoryId) ? "selected" : "" ?>>
                        <?= $category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-input">
            <label for="material">Material</label>
            <input name="material" value="<?= $productType->material ?>" id="material" required />
        </div>
        <div class="form-input">
            <label for="price">Preis</label>
            <input name="price" value="<?= $productType->price ?>" id="price" required type="number" step="0.01" />
        </div>
        <div class="form-input">
            <label for="description">Beschreibung</label>
            <input name="description" value="<?= $productType->description ?>" id="description" required />
        </div>
        <div class="form-input">
            <label for="collection">Collection</label>
            <input name="collection" value="<?= $productType->collection ?>" id="collection" required />
        </div>
        <div class="form-input">
            <label for="careInstructions">Waschanweisungen</label>
            <input name="careInstructions" value="<?= $productType->careInstructions ?>" id="careInstructions" required />
        </div>
        <div class="form-input">
            <label for="origin">Herkunft</label>
            <input name="origin" value="<?= $productType->origin ?>" id="origin" required />
        </div>
        <div class="form-input">
            <label for="extraFields">Zusätzliche Angaben</label>
            <textarea name="extraFields" id="extraFields">
                <?= $productType->extraFields ?>
            </textarea>
        </div>
        <div class="form-input">
            <label for="sizes">Größen</label>
            <select name="sizes[]" id="sizes" required multiple>
                <?php foreach ($optionalSizes as $size): ?>
                    <option value="<?= $size->id ?>" <?= (in_array($size->id, $productType->getSizeIds(), true)) ? "selected" : "" ?>>
                        <?= $size->size ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-input">
            <label for="sizes">Farben</label>
            <select name="colors[]" id="sizes" required multiple>
                <?php foreach ($optionalColors as $color): ?>
                    <option value="<?= $color->id ?>" <?= (in_array($color->id, $productType->getColorIds(), true)) ? "selected" : "" ?>>
                        <?= $color->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="btn" type="submit">
            Speichern.
        </button>
    </form>
    <?php endif; ?>

    <?php if ($errorMessage !== null && $productType === null): ?>
        <h1 class="error-message"><?= $errorMessage ?></h1>
    <?php endif; ?>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

