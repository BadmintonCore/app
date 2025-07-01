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
use Vestis\Service\DeletionValidationService;

/** @var array<int, Size> $sizes */

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

    <h1>Größen</h1>

    <?php if (isset($errorMessage)) : ?>
        <h4 class="error-message"><?= $errorMessage ?></h4>
    <?php endif; ?>

    <a href="/admin/sizes/create" class="btn btn-sm">Erstellen</a>

    <table class="mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Ändern</th>
                <th>Löschen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sizes as $size): ?>
            <tr>
                <td><?= $size->id ?></td>
                <td><?= $size->size ?></td>
                <td><a class="btn btn-sm" href="/admin/sizes/edit?id=<?= $size->id ?>">Ändern.</a></td>
                <?php $deletionValidation = DeletionValidationService::validateSizeDeletion($size->id)?>
                <td><a class="btn btn-sm danger <?= $deletionValidation !== null ? 'disabled' : '' ?>"
                        <?= $deletionValidation !== null ? "" : sprintf("href='/admin/sizes/delete?id=%s'", $size->id)?>
                        <?= $deletionValidation !== null ? sprintf('title="%s"', $deletionValidation) : '' ?>>
                        Löschen.</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>