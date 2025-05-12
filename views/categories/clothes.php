<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Kleidung</title>
    <?php include("../components/head.php"); ?>
</head>
<body>

<!--Header der Website-->
<?php include("../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Breadcrumbs-->
    <?php include("../components/breadcrumbs.php"); ?>

    <script id="breadcrumb-data">
        [
            {"name": "Startseite", "url": "/index.php"},
            {"name": "Kleidung", "url": null}
        ]
    </script>

    <!--Zurückbutton-->
    <?php include("../components/back-btn.php"); ?>

    <h1>Kleidung</h1>

    <a class="btn" href="/categories?categoryId=shirt">Shirts shoppen.</a><br>

    <a class="btn" href="/categories?categoryId=sweater">Sweater shoppen.</a>



</main>

<!--Footer der Website-->
<?php include("../components/footer.php"); ?>
<?php include("../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->
