<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../components/head.php"); ?>
    <title>vestis. - Startseite</title>
</head>
<body>
<?php include(__DIR__."/../components/header.php"); ?>

<main class="banner-content">

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <div>
        <img src="/img/index-banner.png" alt="Banner" class="banner-image">
    </div>

    <h1 id="typeWriter">&nbsp;</h1> <!-- Non breaking space, damit immer ein Inhalt im Tag ist - auch wenn TypeWriting aktuell leer ist -->
    <div class="card-flex p-5">
        <?php include(__DIR__."/../components/productCards.php"); ?>
    </div>
</main>

<?php include(__DIR__."/../components/footer.php"); ?>
<?php include(__DIR__."/../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../components/scripts.php"); ?>
<script src="/js/typeWriter.js"></script>
</body>
</html>
<!--Author: Lennart Moog-->