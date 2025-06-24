<?php

use Vestis\Database\Models\Category;
use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Size;

/** @var Category[] $optionalCategories */
/** @var Size[] $optionalSizes */
/** @var Color[] $optionalColors */
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

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>

    <h1>Produkt Typ erstellen</h1>
    <form method="post" class="form-box">
        <?php if (isset($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage ?></div>
        <?php endif; ?>
        <div class="form-input">
            <label for="name">Name</label>
            <input name="name" id="name" required />
        </div>
        <div class="form-input">
            <label for="categoryId">Kategorie</label>
            <select name="categoryId" id="categoryId" required>
                <?php foreach ($optionalCategories as $category): ?>
                    <option value="<?= $category->id ?>">
                        <?= $category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-input">
            <label for="material">Material</label>
            <input name="material" id="material" required />
        </div>
        <div class="form-input">
            <label for="price">Preis</label>
            <input name="price" id="price" required type="number" step="0.01" />
        </div>
        <div class="form-input">
            <label for="description">Beschreibung</label>
            <input name="description" id="description" required />
        </div>
        <div class="form-input">
            <label for="collection">Collection</label>
            <input name="collection" id="collection" required />
        </div>
        <div class="form-input">
            <label for="careInstructions">Waschanweisungen</label>
            <input name="careInstructions" id="careInstructions" required />
        </div>
        <div class="form-input">
            <label for="origin">Herkunft</label>
            <input name="origin" id="origin" required />
        </div>
        <div class="form-input">
            <label for="extraFields">Zusätzliche Angaben</label>
            <textarea name="extraFields" id="extraFields"></textarea>
        </div>
        <div class="form-input">
            <label for="sizes">Größen</label>
            <select name="sizes[]" id="sizes" required multiple>
                <?php foreach ($optionalSizes as $size): ?>
                    <option value="<?= $size->id ?>">
                        <?= $size->size ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-input">
            <label for="sizes">Farben</label>
            <select name="colors[]" id="sizes" required multiple>
                <?php foreach ($optionalColors as $color): ?>
                    <option value="<?= $color->id ?>">
                        <?= $color->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="btn" type="submit">
            Speichern.
        </button>
    </form>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

