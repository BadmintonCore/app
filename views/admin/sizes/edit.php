<?php

use Vestis\Database\Models\Size;

/** @var Size|null $size */
?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Größen</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>
    <?php if (isset($errorMessage) || $size === null): ?>
    <h1><?= $errorMessage ?? 'Not found' ?></h1>
    <?php else: ?>
    <h1><?= $size->size ?></h1>
    <form method="post" class="form-box">
        <div class="form-input">
            <label for="name">Name der Größe</label>
            <input name="size" value="<?= $size->size ?>" id="name" required />
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

