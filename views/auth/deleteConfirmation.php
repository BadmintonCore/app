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
<!DOCTYPE html>
<html lang="de">
<head>
    <?php
    include(__DIR__ . "/../../components/head.php"); ?>
    <title>vestis. - Account löschen</title>
</head>

<!--Header der Website-->
<?php include(__DIR__ . "/../../components/header.php"); ?>

<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <form class="form-box" id="deleteForm" method="post">

        <h1>Account löschen</h1>
        <?php include(__DIR__ . "/../../components/back-btn.php"); ?>

        <?php if (isset($errorMessage)) : ?>
            <h4 class="error-message"><?= $errorMessage ?></h4>
        <?php endif; ?>

        <h3 id="deleteAccount"></h3>

        <script>
            var lastUsername = sessionStorage.getItem("lastUsername");
            var confirmation = lastUsername ? "Bist du sicher, dass du deinen Account löschen möchtest, " + lastUsername + "?" : "Bist du sicher, dass du deinen Account löschen möchtest?";
            document.getElementById("deleteAccount").innerHTML = confirmation;
        </script>

        <div class="button-row-center">
            <button type="submit" class="btn danger">
                Account löschen
            </button>

            <a href="/" class="btn secondary">
                Account behalten
            </a>
        </div>

    </form>
</main>

<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__ . "/../../components/scripts.php"); ?>
</html>