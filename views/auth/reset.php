<!--Autor(en): Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__ . "/../../components/head.php"); ?>
    <title>vestis. - Passwort zurücksetzen</title>
</head>
<body>

<!--Header der Website-->
<?php include(__DIR__ . "/../../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Formular der Klasse loginRegisterReset-->
    <form class="form-box" method="post">

        <!--Seitenüberschrift-->
        <h1>
            Passwort zurücksetzen
        </h1>

        <!--Zurückbutton-->
        <a class="back-btn" id="backButton" href="/../../auth/login">
            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            <span>Zurück</span>
        </a>

        <?php if (isset($errorMessage)) : ?>
            <h4 class="error-message"><?= $errorMessage ?></h4>
        <?php endif; ?>
        <?php if (isset($successMessage)) : ?>
            <h4 class="success-message"><?= $successMessage ?></h4>
            <a href="/auth/login" class="btn">
                login.
            </a>
        <?php else: ?>
        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="mail">
                <b>E-Mail</b>
            </label>

            <!--Input für die E-Mail-->
            <input type="email" id="mail" placeholder="E-Mail eingeben" name="mail" required>
        </div>

        <!--Button zum Einreichen (submit)-->
        <button type="submit" class="btn align-start">
            zurücksetzen.
        </button>
    </form>
    <?php endif; ?>
</main>

<!--Footer der Website-->
<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__ . "/../../components/scripts.php"); ?>
</body>
</html>
<!--Autor(en): Lennart Moog-->