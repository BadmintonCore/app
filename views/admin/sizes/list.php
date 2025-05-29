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
    <a href="/admin/sizes/create" class="btn btn-sm">Erstellen</a>

    <table class="mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sizes as $size): ?>
            <tr>
                <td><?= $size->id ?></td>
                <td><?= $size->size ?></td>
                <td><a class="btn btn-sm" href="/admin/sizes/edit?id=<?= $size->id ?>">Edit.</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

