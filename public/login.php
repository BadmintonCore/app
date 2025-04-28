<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>vestis. - Einloggen</title>

    <!--Keywords für die Suchmaschine-->
    <meta name="keywords" content="clothing, fashion, kleidung">

    <!--Reference to mystyle.css-->
    <link rel="stylesheet" type="text/css" href="mystyle.css">

    <!--Reference to authValidation.js-->
    <script src="js/authValidation.js" defer></script>
    <!--Defer: JavaScript wird erst ausgeführt, wenn HTML-Seite fertig geparst ist
    Alternative: Script am Ende vom body erst aufführen-->


    <!--vestis.-Logo in Browser-Tab-->
    <link rel="shortcut icon" href="/img/logo.png" />
</head>
<body>

<!--Header der Website-->
<?php include("../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Formular der Klasse form-box-->
    <form class="form-box" id="loginForm">

        <!--Seitenüberschrift-->
        <h1>
            Einloggen
        </h1>

        <!--Zurückbutton-->
        <?php include("../components/back-btn.php"); ?>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="username">
                <b>Benutzername/E-Mail</b>
            </label>

            <!--Input für den Benutzernamen-->
            <input type="text" id="username" placeholder="Benutzername oder E-Mail eingeben" name="username" required>
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
        <button type="submit" class="btn align-start" id="subBtn" disabled>
            login.
        </button>

        <p id="message"></p>

        <br/>

        <!--Container mit der id "resetAndRegister"-->
        <div id="resetAndRegister">
            <a href="reset.php">
                Passwort zurücksetzen
            </a>
            <hr/>
            <a href="registration.php">
                Jetzt registrieren
            </a>
        </div>
    </form>
</main>

<!--Footer der Website-->
<?php include("../components/footer.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->