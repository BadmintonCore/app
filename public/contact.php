<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>vestis. - Kontakt</title>

    <!--Keywords für die Suchmaschine-->
    <meta name="keywords" content="clothing, fashion, kleidung">

    <!--Reference to mystyle.css-->
    <link rel="stylesheet" type="text/css" href="mystyle.css">

    <!--Reference to authValidation.js-->
    <script src="js/authValidation.js" defer></script>
    <!--Defer: JavaScript wird erst ausgeführt, wenn HTML-Seite fertig geparst ist
    Alternative: Script am Ende vom body erst aufführen-->


    <!--vestis.-Logo in Browser-Tab-->
    <link rel="shortcut icon" href="/img/logo.png"/>
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
            Kontaktformular
        </h1>

        <!--Zurückbutton-->
        <?php include("../components/back-btn.php"); ?>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="email">
                <b>E-Mail</b>
            </label>

            <!--Input für den Benutzernamen-->
            <input type="email" id="email" placeholder="E-Mail eingeben" name="email" required>
        </div>

        <div class="form-input">
            <label for="message">
                <b>Deine Nachricht</b>
            </label>

            <textarea id="message" placeholder="Nachricht eingeben" name="message" required></textarea>
        </div>

        <!--Button zum Einreichen (submit)-->
        <button type="submit" class="btn align-start">
            abschicken.
        </button>
    </form>
</main>

<!--Footer der Website-->
<?php include("../components/footer.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->