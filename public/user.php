<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>vestis. - Benutzerbereich</title>

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

<!--Header der Website-->
<?php include("../components/header.php"); ?>

<main>

    <form class="form-box" id="userForm">

        <h1>Benutzerbereich</h1>
        <?php include("../components/back-btn.php"); ?>

        <div class="form-input">
            <label for="username"><b>Benutzername</b></label>
            <input type="text" id="username" name="username" value="TestNutzer" required>
        </div>
        <br/>
        <div class="form-input">
            <label for="email"><b>E-Mail</b></label>
            <input type="email" id="email" name="email" value="kontakt@vestis.de" required>
        </div>
        <br/>
        <div class="form-input">
            <label for="password"><b>Aktuelles Passwort</b></label>
            <input type="password" id="password" name="password" value="meinsupersicheresPasswort123" required>
        </div>
        <br/>
        <button type="submit" class="btn align-start" id="subBtn" disabled>
            aktualisieren.
        </button>
    </form>
</main>
<?php include("../components/footer.php"); ?>
</html>
<!--Author: Lennart Moog-->