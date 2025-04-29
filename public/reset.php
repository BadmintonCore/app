<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("../components/head.php"); ?>
    <title>vestis. - Passwort zurücksetzen</title>
</head>
<body>

<!--Header der Website-->
<?php include("../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Formular der Klasse loginRegisterReset-->
    <form class="form-box">

        <!--Seitenüberschrift-->
        <h1>
            Passwort zurücksetzen
        </h1>

        <!--Zurückbutton-->
        <?php include("../components/back-btn.php"); ?>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="mail">
                <b>E-Mail</b>
            </label>

            <!--Input für die E-Mail-->
            <input type="email" id="mail" placeholder="E-Mail eingeben" name="mail" required
                   oninvalid="this.setCustomValidity('Bitte eine gültige E-Mail eingeben.')">
        </div>

        <!--Button zum Einreichen (submit)-->
        <button type="submit" class="btn align-start">
            zurücksetzen.
        </button>
    </form>
</main>

<!--Footer der Website-->
<?php include("../components/footer.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->