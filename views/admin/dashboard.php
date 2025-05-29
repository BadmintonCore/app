<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Admin</title>
    <?php include(__DIR__."/../../components/head.php"); ?>
</head>
<body>

<?php include(__DIR__."/../../components/adminHeader.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <h1>Dashboard</h1>

    <div class="stack">
        <a href="/admin/categories" class="btn">Kategorien.</a>
        <a href="/admin/colors" class="btn">Farben.</a>
        <a href="/admin/sizes" class="btn">Größen.</a>
        <a href="/admin/productTypes" class="btn">Produkt Typen.</a>
        <a href="/admin/images" class="btn">Bilder.</a>
    </div>



</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

