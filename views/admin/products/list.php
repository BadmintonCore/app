<?php

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\Product;
use Vestis\Utility\PaginationUtility;

/** @var PaginationDto<Product> $products */
/** @var int $page */
/** @var int $productTypeId */
?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Produkte</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>


    <h1>Produkte</h1>
    <a href="/admin/productTypes/instances/create?id=<?= $productTypeId ?>" class="btn btn-sm">Erstellen</a>
    <table class="mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Größe</th>
            <th>Farbe</th>
            <th>Status</th>
            <th>Gekauft am</th>
            <th>Kaufpreis</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products->results as $product): ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->getSize()->size ?></td>
                <td><?= $product->getColor()->name ?></td>
                <td><?= $product->boughtAt !== null ? 'Verkauft' : 'Im Lager' ?></td>
                <td><?= $product->boughtAt ?></td>
                <td><?= $product->boughtPrice ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    PaginationUtility::generatePagination($products->count, 25, $page);
    ?>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

