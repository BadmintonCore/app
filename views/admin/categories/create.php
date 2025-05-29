<?php

use Vestis\Database\Models\Category;

/** @var Category[] $optionalParentCategories */
?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Kategorien</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>

    <h1>Kategorie erstellen</h1>
    <form method="post" class="form-box">
        <?php if (isset($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage ?></div>
        <?php endif; ?>
        <div class="form-input">
            <label for="name">Name der Kategorie</label>
            <input name="name" id="name" required />
        </div>
        <div class="form-input">
            <label for="parentCategoryId">Übergeordnete Kategorie</label>
            <select name="parentCategoryId" id="parentCategoryId" required>
                <option value="-1"> -- Keine --</option>
                <?php foreach ($optionalParentCategories as $parentCategory): ?>
                    <option value="<?= $parentCategory->id ?>">
                        <?= $parentCategory->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button class="btn" type="submit">
            Erstellen.
        </button>
    </form>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

