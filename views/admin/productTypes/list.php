<?php

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\ProductType;
use Vestis\Utility\PaginationUtility;

/** @var PaginationDto<ProductType> $productTypes */
/** @var int $page */
?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Produkt Typen</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>


    <h1>Produkt Typen</h1>

    <?php if (isset($errorMessage)): ?>
        <div class="error-message"><?= $errorMessage ?></div>
    <?php endif; ?>

    <a href="/admin/productTypes/create" class="btn btn-sm">Erstellen</a>
    <table class="mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Kategorie</th>
                <th>Preis</th>
                <th>Ändern</th>
                <th>Löschen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productTypes->results as $productType): ?>
            <tr>
                <td><?= $productType->id ?></td>
                <td><?= $productType->name ?></td>
                <td>
                    <a href="/admin/categories/edit?id=<?= $productType->getCategory()->id ?>"><?= $productType->getCategory()->name ?></a>
                </td>
                <td class="price-field"><?= $productType->price ?>€</td>
                <td><a class="btn btn-sm" href="/admin/productTypes/edit?id=<?= $productType->id ?>">Ändern.</a></td>
                <td><a class="btn btn-sm danger" href="/admin/productTypes/delete?id=<?= $productType->id ?>">Löschen.</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
        PaginationUtility::generatePagination($productTypes->count, 10, $page);
?>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

