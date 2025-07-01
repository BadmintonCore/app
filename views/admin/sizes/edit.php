<?php
/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
?>
<?php

use Vestis\Database\Models\Size;

/** @var Size|null $size */
/** @var string|null $errorMessage */
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
    <?php if ($size !== null) : ?>
    <h1><?= $size->size ?></h1>
    <form method="post" class="form-box">
        <?php if (isset($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage ?></div>
        <?php endif; ?>
        <div class="form-input">
            <label for="name">Name der Größe</label>
            <input name="size" value="<?= $size->size ?>" id="name" required />
        </div>
        <button class="btn" type="submit">
            Speichern.
        </button>
    </form>
    <?php endif; ?>

    <?php if ($errorMessage !== null && $size === null) : ?>
    <h1 class="error-message"><?= $errorMessage ?></h1>
    <?php endif; ?>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>