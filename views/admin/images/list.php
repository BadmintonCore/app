<?php

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Image;
use Vestis\Utility\PaginationUtility;

/** @var PaginationDto<Image> $images */
/** @var int $page */
?>

<!--Author: Lennart Moog-->
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

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>


    <h1>Bilder</h1>
    <a href="/admin/images/create" class="btn btn-sm">Erstellen</a>
    <table class="mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images->results as $image): ?>
            <tr>
                <td><?= $image->id ?></td>
                <td><?= $image->name ?></td>
                <td><a class="btn btn-sm" href="/admin/images/view?id=<?= $image->id ?>">View.</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
        PaginationUtility::generatePagination($images->count, 10, $page);
?>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

