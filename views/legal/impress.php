<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>vestis. - Impressum</title>
</head>
<body>

<!--Header der Website-->
<?php include(__DIR__."/../../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>



    <h1>Impressum</h1>

    <!--Absatz mit Impressums-Text-->
    <?= \Vestis\Database\Repositories\GCR::getValue('IMPRESS_CONTENT') ?>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->