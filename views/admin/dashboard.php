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

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <a href="/user-area/user" class="btn btn-sm">Benutzerbereich.</a>
    <h1>Dashboard</h1>

    <div class="stack">
        <a href="/admin/categories" class="btn">Kategorien.</a>
        <a href="/admin/colors" class="btn">Farben.</a>
        <a href="/admin/sizes" class="btn">Größen.</a>
        <a href="/admin/productTypes" class="btn">Produkttypen.</a>
        <a href="/admin/images" class="btn">Bilder.</a>
        <a href="/admin/globalConfigs" class="btn">Konfigurationen.</a>
    </div>



</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

