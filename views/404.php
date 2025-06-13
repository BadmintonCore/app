<!--Author: Mathis Burger-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Über uns</title>
    <?php include(__DIR__."/../components/head.php"); ?>
</head>
<body>

<!--Header der Website-->
<?php include(__DIR__."/../components/header.php"); ?>
<!--Inhalt der Seite-->
<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Zurückbutton-->
    <a class="back-btn" id="backButton" href="/../../">
        <!--Grafik von: https://getbootstrap.com/-->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
        <span>Zurück</span>
    </a>

    <h1>OOPS 404 NOT FOUND</h1>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../components/footer.php"); ?>
<?php include(__DIR__."/../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../components/scripts.php"); ?>
</body>
</html>
<!--Author: Mathis Burger-->