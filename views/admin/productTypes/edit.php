<?php

use Vestis\Database\Models\Category;
use Vestis\Database\Models\ProductType;

/** @var ProductType|null $productType */
/** @var Category[] $optionalCategories */
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
        <div class="form-input">
            <label for="name">Name</label>
            <input name="name" value="<?= $productType->name ?>" id="name" required />
        </div>
        <div class="form-input">
            <label for="categoryId">Kategorie</label>
            <select name="categoryId" id="categoryId" required>
                <?php foreach ($optionalCategories as $category): ?>
                    <option value="<?= $category->id ?>" <?= ($category->id == $productType->categoryId) ? "selected" : "" ?>>
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
            <input name="price" value="<?= $productType->price ?>" id="price" required type="number" />
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
            <textarea name="extraFields" id="extraFields" required>
                <?= $productType->extraFields ?>
            </textarea>
        </div>
        <button class="btn" type="submit">
            Speichern.
        </button>
    </form>
    <?php endif; ?>

    <?php if (isset($errorMessage) && $productType === null): ?>
        <h1 class="error-message"><?= $errorMessage ?></h1>
    <?php endif; ?>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

