<?php

use Vestis\Database\Models\Category;
use Vestis\Utility\BreadcrumbsUtility;

/** @var Category $category */

?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Accesoires</title>
    <?php include(__DIR__."/../../components/head.php"); ?>
</head>
<body>

<!--Header der Website-->
<?php include(__DIR__."/../../components/header.php"); ?>
<!--Inhalt der Seite-->
<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <h1><?= $category->name ?></h1>

    <?php foreach ($category->getChildCategories() as $childCategory): ?>
        <?php
            $uri = sprintf('/categories?categoryId=%s&%s=%s', $childCategory->id, BreadcrumbsUtility::FIELD_NAME, BreadcrumbsUtility::generateCategoryBreadcrumbsBase64($childCategory));
        ?>
        <a class="btn" href="<?= $uri ?>"><?= $childCategory->name ?> shoppen.</a><br>
    <?php endforeach; ?>



</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

