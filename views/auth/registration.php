<!--Author: Lasse Hoffmann-->

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>vestis. - Registrieren</title>
    <script src="../../public/js/authValidation.js" defer></script>
</head>
<body>

<!--Header der Website-->
<?php include(__DIR__."/../../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Formular der Klasse "form-box"-->
    <form class="form-box" id="registrationForm" method="post">

        <!--Seitenüberschrift-->
        <h1>
            Registrieren
        </h1>

        <?php if (isset($validationError)) : ?>
            <h4 class="error-message"><?= $validationError ?></h4>
        <?php endif; ?>

        <!--Zurückbutton-->
        <?php include(__DIR__."/../../components/back-btn.php"); ?>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="firstname">
                <b>Vorname<sup>*</sup></b>
            </label>

            <!--Input für den Vornamen-->
            <input type="text" id="firstname" placeholder="Vorname eingeben" name="firstName" required>
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

            <!--Span für die Error-Message, falls Benutzername nicht den Vorgaben entspricht-->
            <span id="usernameInputSpan" class="input-auth-error-msg"></span>
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

            <!--Span für die Error-Message, falls Passwort nicht den Vorgaben entspricht-->
            <span id="passwordInputSpan" class="input-auth-error-msg"></span>
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

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label class="checkbox">
                <!--Input für die Newsletter-Abfrage-->
                <input type="checkbox" id="newsletter" name="newsletter">
                <p>Ich möchte Angebote über exklusive Kollektionen und Angebote erhalten</p>
            </label>
        </div>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label class="checkbox">
                <!--Input für die AGB-Abfrage-->
                <input type="checkbox" id="agb" name="agb" required>
                <p>Ich habe die <u><a href="../legal/gtc.php">AGBs</a></u> gelesen und akzeptiere diese<sup>*</sup></p>
            </label>
        </div>

        <p class="text-align-left"><sup>*</sup> Pflichtfeld</p>

        <br/>

        <!--Container der Klasse "button-row"-->
        <div class="button-row">

            <!--Abbrechen "Button" als Link-->
            <a href="/auth/login" class="btn secondary" id="cancelBtn">
                abbrechen.
            </a>

            <!--Button zum Einreichen (submit)-->
            <button type="submit" class="btn" id="subBtn">
                registrieren.
            </button>
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