<!--Author: Lasse Hoffmann-->

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

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>
    <script id="breadcrumb-data">
        [
            {"name": "Startseite", "url": "/index.php"},
            {"name": "Login", "url": null}
        ]
    </script>

    <!--Formular der Klasse "form-box"-->
    <form class="form-box" id="loginForm" method="post">

        <!--Seitenüberschrift-->
        <h1>
            Einloggen
        </h1>

        <!--Zurückbutton-->
        <?php include(__DIR__."/../../components/back-btn.php"); ?>

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
<!--Author: Lasse Hoffmann-->