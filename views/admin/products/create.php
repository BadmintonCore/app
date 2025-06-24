<!--Autor(en): Lasse Hoffmann-->
<?php

use Vestis\Database\Models\Category;
use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Size;

/** @var ProductType $productType */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Produkte</title>
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

    <h1>Produkte erstellen</h1>
    <form method="post" class="form-box">
        <?php if (isset($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage ?></div>
        <?php endif; ?>
        <div class="form-input">
            <label for="quantity">Anzahl</label>
            <input name="quantity" type="number" id="quantity" required />
        </div>
        <div class="form-input">
            <label for="sizes">Größe</label>
            <select name="size" id="sizes" required>
                <?php foreach ($productType->getSizes() as $size): ?>
                    <option value="<?= $size->id ?>">
                        <?= $size->size ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-input">
            <label for="sizes">Farbe</label>
            <select name="color" id="sizes" required>
                <?php foreach ($productType->getColors() as $color): ?>
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
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Autor(en): Lasse Hoffmann-->