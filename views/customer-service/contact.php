<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Kontakt</title>
    <?php include(__DIR__."/../../components/head.php"); ?>
</head>
<body>

<!--Header der Website-->
<?php include(__DIR__."/../../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <!--Formular der Klasse "form-box"-->
    <form class="form-box" id="loginForm">

        <!--Seitenüberschrift-->
        <h1>
            Kontaktformular
        </h1>

        <!--Zurückbutton-->
        <?php include(__DIR__."/../../components/back-btn.php"); ?>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="email">
                <b>E-Mail</b>
            </label>

            <!--Input für die E-Mail-->
            <input type="email" id="email" placeholder="E-Mail eingeben" name="email" required>
        </div>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="message">
                <b>Deine Nachricht</b>
            </label>

            <!--Textarea für die Nachricht des Benutzers-->
            <textarea id="message" placeholder="Nachricht eingeben" name="message" required></textarea>
        </div>

        <!--Button zum Einreichen (submit)-->
        <button type="submit" class="btn align-start">
            abschicken.
        </button>
    </form>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->