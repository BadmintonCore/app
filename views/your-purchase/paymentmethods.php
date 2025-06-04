<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Zahlungsmethoden</title>
    <?php include(__DIR__."/../../components/head.php"); ?>
</head>
<body>

<!--Header der Website-->
<?php include(__DIR__."/../../components/header.php"); ?>
<!--Inhalt der Seite-->
<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <!--Zurückbutton-->
    <?php include(__DIR__."/../../components/back-btn.php"); ?>

    <h1>Zahlungsmethoden</h1>

    <!--Abschnitt mit mehreren Absätzen-->
    <section>
        <?= \Vestis\Database\Repositories\GCR::getValue('PAYMENT_METHODS_CONTENT ') ?>
    </section>


</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->