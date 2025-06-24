<!--Autor(en): Lennart Moog-->

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>vestis. - Einloggen</title>
    <script src="/js/authValidation.js" defer></script>
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


    <!--Formular der Klasse "form-box"-->
    <form class="form-box" id="loginForm" method="post">

        <!--Seitenüberschrift-->
        <h1>
            Einloggen
        </h1>


        <!--Zurück-Button-->
        <a class="back-btn" id="backButton" href="/../../">
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

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="username">
                <b>Benutzername</b>
            </label>

            <!--Input für den Benutzernamen-->
            <input type="text" id="username" placeholder="Benutzername eingeben" name="username" required>
        </div>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="password">
                <b>Passwort</b>
            </label>

            <!--Input für das Passwort-->
            <input type="password" id="password" placeholder="Passwort eingeben" name="password" required>
        </div>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label class="checkbox">

                <!--Checkbox für "Angemeldet bleiben"-->
                <input type="checkbox" name="rememberMe">
                Angemeldet bleiben
            </label>
        </div>

        <!--Button zum Einreichen (submit)-->
        <button type="submit" class="btn align-start" id="subBtn">
            login.
        </button>

        <br/>

        <!--Container mit der id "resetAndRegister"-->
        <div id="resetAndRegister">
            <a href="/auth/reset">
                Passwort zurücksetzen
            </a>
            <hr/>
            <a href="/auth/registration">
                Jetzt registrieren
            </a>
        </div>
    </form>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
<script src="/js/authValidation.js" defer></script>
</body>
</html>
<!--Autor(en): Lennart Moog-->