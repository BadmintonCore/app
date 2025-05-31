<?php

use Vestis\Database\Models\Size;

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
                <td><a class="btn btn-sm danger" href="/admin/sizes/delete?id=<?= $size->id ?>">Löschen.</a></td>
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
<!--Author: Lennart Moog -->

