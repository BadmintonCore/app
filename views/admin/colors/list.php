<?php

use Vestis\Database\Models\Color;
use Vestis\Service\DeletionValidationService;

/** @var array<int, Color> $colors */

?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Farben</title>
    <?php include(__DIR__ . "/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__ . "/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__ . "/../../../components/breadcrumbs.php"); ?>

    <h1>Farben</h1>

    <?php if (isset($errorMessage)) : ?>
        <h4 class="error-message"><?= $errorMessage ?></h4>
    <?php endif; ?>

    <a href="/admin/colors/create" class="btn btn-sm">Erstellen</a>

    <table class="mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Hex</th>
            <th>Ändern</th>
            <th>Löschen</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($colors as $color): ?>
            <tr>
                <td><?= $color->id ?></td>
                <td><?= $color->name ?></td>
                <td>
                    <div class="flex-row">
                        #<?= $color->hex ?>
                        <div class="color-circle" style="background: #<?= $color->hex ?>"></div>
                    </div>
                </td>
                <td><a class="btn btn-sm" href="/admin/colors/edit?id=<?= $color->id ?>">Ändern.</a></td>
                <?php $deletionValidation = DeletionValidationService::validateColorDeletion($color->id)?>
                <td><a class="btn btn-sm danger <?= $deletionValidation !== null ? 'disabled' : '' ?>"
                        <?= $deletionValidation !== null ? "" :  sprintf("href='/admin/colors/delete?id=%s'", $color->id)?>
                    <?= $deletionValidation !== null ? sprintf('title="%s"', $deletionValidation) : '' ?>>
                    Löschen.</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>

<!--Footer der Website-->
<?php include(__DIR__ . "/../../../components/adminFooter.php"); ?>
<?php include(__DIR__ . "/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

