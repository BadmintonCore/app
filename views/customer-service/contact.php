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
    <form class="form-box" id="contactForm" method="post">

        <!--Seitenüberschrift-->
        <h1>
            Kontaktformular
        </h1>

        <!--Zurückbutton-->
        <?php include(__DIR__."/../../components/back-btn.php"); ?>

        <?php if (isset($errorMessage)) : ?>
            <h4 class="error-message"><?= $errorMessage ?></h4>
        <?php endif; ?>
        <?php if (isset($feedbackMessage)) : ?>
            <h4 class="success-message"><?= $feedbackMessage ?></h4>
        <?php endif; ?>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="name">
                <b>Vollständiger Name</b>
            </label>

            <!--Input für die E-Mail-->
            <input type="text" id="name" placeholder="Namen eingeben" name="name" required>
        </div>

        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="email">
                <b>E-Mail</b>
            </label>

            <!--Input für die E-Mail-->
            <input type="email" id="email" placeholder="E-Mail eingeben" name="email" required>
        </div>

        <!--Container der Klasse "form-input" und "flex-row"-->
        <div class="flex-row form-input">
            <label>
                <input type="radio" name="evaluation" value="1">
                1 Stern
            </label>
            <label>
                <input type="radio" name="evaluation" value="2">
                2 Sterne
            </label>
            <label>
                <input type="radio" name="evaluation" value="3">
                3 Sterne
            </label>
            <label>
                <input type="radio" name="evaluation" value="4">
                4 Sterne
            </label>
            <label>
                <input type="radio" name="evaluation" value="5">
                5 Sterne
            </label>
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