<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__ . "/../../components/head.php"); ?>
    <title>vestis. - Passwort zurücksetzen</title>
</head>
<body>

<!--Header der Website-->
<?php include(__DIR__ . "/../../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Formular der Klasse loginRegisterReset-->
    <form class="form-box" method="post">

        <!--Seitenüberschrift-->
        <h1>
            Passwort zurücksetzen
        </h1>

        <!--Zurückbutton-->
        <?php include(__DIR__ . "/../../components/back-btn.php"); ?>

        <?php if (isset($errorMessage)) : ?>
            <h4 class="error-message"><?= $errorMessage ?></h4>
        <?php endif; ?>
        <?php if (isset($successMessage)) : ?>
            <h4 class="success-message"><?= $successMessage ?></h4>
            <a href="/auth/login" class="btn">
                login.
            </a>
        <?php else: ?>
        <!--Container der Klasse "form-input"-->
        <div class="form-input">
            <label for="mail">
                <b>E-Mail</b>
            </label>

            <!--Input für die E-Mail-->
            <input type="email" id="mail" placeholder="E-Mail eingeben" name="mail" required>
        </div>

        <!--Button zum Einreichen (submit)-->
        <button type="submit" class="btn align-start">
            zurücksetzen.
        </button>
    </form>
    <?php endif; ?>
</main>

<!--Footer der Website-->
<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__ . "/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->