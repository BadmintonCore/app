<?php
/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
?>
<?php
/** @var string $errorMessage */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../components/head.php"); ?>
    <title>vestis. - Fehler</title>
</head>
<body>
<?php include(__DIR__."/../components/header.php"); ?>

<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>


<!--Zurück-Button-->
    <a class="back-btn" id="backButton" href="/../../">
        <!--Grafik von: https://getbootstrap.com/-->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
        <span>Zurück</span>
    </a>

    <h1 class="error-message">Fehler!</h1>
    <h3 class="error-message"><?= $errorMessage ?></h3>
</main>

<?php include(__DIR__."/../components/footer.php"); ?>
<?php include(__DIR__."/../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../components/scripts.php"); ?>
</body>
</html>