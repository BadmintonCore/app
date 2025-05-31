<?php

use Vestis\Database\Models\Category;

/** @var array<int, Category> $categories */

?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Kategorien</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>


    <h1>Kategorien</h1>

    <?php if (isset($errorMessage)) : ?>
        <h4 class="error-message"><?= $errorMessage ?></h4>
    <?php endif; ?>

    <a href="/admin/categories/create" class="btn btn-sm">Erstellen</a>
    <table class="mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Übergeordnete Kategorie</th>
                <th>Ändern</th>
                <th>Löschen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $category->id ?></td>
                <td><?= $category->name ?></td>
                <td>
                    <?php if ($category->getParentCategory() !== null) : ?>
                        <a href="/admin/categories/edit?id=<?= $category->getParentCategory()->id ?>"><?= $category->getParentCategory()->name ?></a>
                    <?php endif; ?>
                </td>
                <td><a class="btn btn-sm" href="/admin/categories/edit?id=<?= $category->id ?>">Edit.</a></td>
                <td><a class="btn btn-sm danger" href="/admin/categories/delete?id=<?= $category->id ?>">Löschen.</a></td>
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

