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

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Image;
use Vestis\Utility\PaginationUtility;

/** @var PaginationDto<Image> $images */
/** @var int[] $assignedImageIds */
/** @var int $page */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Bilder</title>
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


    <h1>Zugewiesene Bilder</h1>

    <form class="full-size" method="post" id="paginatedForm">
        <?php if (isset($errorMessage)): ?>
        <h2 class="error-message"><?= $errorMessage ?></h2>
        <?php endif; ?>
        <table class="mt-4">
            <thead>
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Zugewiesen?</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($images->results as $image): ?>
                <tr>
                    <td><?= $image->name ?></td>
                    <td><?= $image->id ?></td>
                    <td><input type="checkbox" name="assigned[]" value="<?= $image->id ?>" <?= in_array($image->id, $assignedImageIds, true) ? 'checked' : '' ?>  /></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit" name="submitButton" class="btn mt-4">Speichern.</button>

        <div class="auto-size">
            <?php
            PaginationUtility::generatePagination($images->count, 10, $page, true);
?>
        </div>

    </form>



</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>