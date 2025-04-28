<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>vestis. - Registrieren</title>

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
        <form class="form-box" id="registrationForm">

            <!--Seitenüberschrift-->
            <h1>
                Registrieren
            </h1>

            <!--Zurückbutton-->
            <?php include("../components/back-btn.php"); ?>

            <!--Container der Klasse "form-input"-->
            <div class="form-input">
                <label for="firstname">
                    <b>Vorname<sup>*</sup></b>
                </label>

                <!--Input für den Vornamen-->
                <input type="text" id="firstname" placeholder="Vorname eingeben" name="firstname" required>
            </div>

            <!--Container der Klasse "form-input"-->
            <div class="form-input">
                <label for="surname">
                    <b>Nachname<sup>*</sup></b>
                </label>

                <!--Input für den Nachnamen-->
                <input type="text" id="surname" placeholder="Nachname eingeben" name="surname" required>
            </div>

            <!--Container der Klasse "form-input"-->
            <div class="form-input">
                <label for="username">
                    <b>Benutzername</b>
                </label>

                <!--Input für den Benutzernamen-->
                <input type="text" id="username" placeholder="Benutzername eingeben" name="username">
            </div>

            <!--Container der Klasse "form-input"-->
            <div class="form-input">
                <label for="email">
                    <b>E-Mail<sup>*</sup></b>
                </label>

                <!--Input für die E-Mail-->
                <input type="email" id="email" placeholder="E-Mail eingeben" name="email" required>
            </div>

            <!--Container der Klasse "form-input"-->
            <div class="form-input">
                <label for="password">
                    <b>Passwort<sup>*</sup></b>
                </label>

                <!--Input für das Passwort-->
                <input type="password" id="password" placeholder="Passwort eingeben" name="password" required>
            </div>

            <!--Container der Klasse "form-input"-->
            <div class="form-input">
                <label for="passwordConfirmation">
                    <b>Passwort wiederholen<sup>*</sup></b>
                </label>

                <!--Input für das Passwort-->
                <input type="password" id="passwordConfirmation" placeholder="Passwort eingeben" name="passwordConfirmation"
                       required>
            </div>

            <p class="text-align-left"><sup>*</sup> Pflichtfeld</p>

            <br/>

            <!--Container der Klasse "button-row"-->
            <div class="button-row">

                <!--Abbrechen "Button" als Link-->
                <a href="login.php" class="btn secondary" id="cancelBtn">
                    abbrechen.
                </a>

                <!--Button zum Einreichen (submit)-->
                <button type="submit" class="btn" id="subBtn" disabled>
                    registrieren.
                </button>
            </div>
        </form>
</main>

<!--Footer der Website-->
<?php include("../components/footer.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->