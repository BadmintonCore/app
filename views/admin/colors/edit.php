<?php

use Vestis\Database\Models\Color;

/** @var Color|null $color */
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
    <?php if (isset($errorMessage) || $color === null): ?>
    <h1><?= $errorMessage ?? 'Not found' ?></h1>
    <?php else: ?>
    <h1><?= $color->name ?></h1>
    <form method="post" class="form-box">
        <div class="form-input">
            <label for="name">Name der Farbe</label>
            <input name="name" value="<?= $color->name ?>" id="name" required />
        </div>
        <div class="form-input">
            <label for="hex">Farbe</label>
            <input type="color" name="hex" value="#<?= $color->hex ?>" id="hex" required />
        </div>
        <button class="btn" type="submit">
            Speichern.
        </button>
    </form>
    <?php endif; ?>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

