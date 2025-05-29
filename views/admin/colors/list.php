<?php

use Vestis\Database\Models\Color;

/** @var array<int, Color> $colors */

?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Farben</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>

    <h1>Farben</h1>
    <a href="/admin/colors/create" class="btn btn-sm">Erstellen</a>

    <table class="mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Hex</th>
                <th>Aktionen</th>
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
                <td><a class="btn btn-sm" href="/admin/colors/edit?id=<?= $color->id ?>">Edit.</a></td>
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

