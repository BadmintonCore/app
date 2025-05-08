<!--Author: Lasse Hoffmann-->

<?php

use Vestis\Exception\AuthException;
use Vestis\Exception\DatabaseException;
use Vestis\Exception\ValidationException;
use Vestis\Service\AuthService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $validationRules = [
        'username' => new ValidationRule(ValidationType::String),
        'password' => new ValidationRule(ValidationType::String),
    ];
    try {
        // Validate form
        ValidationService::validateForm($validationRules);

        // Login the user with the given credentials in $_POST
        AuthService::loginUser($_POST["username"], $_POST["password"]);

        // Redirect to landing page after successful login
        header("Location: /");
        return;
    } catch (ValidationException|AuthException|DatabaseException $e) {
        // Sets all exception errors. Those are then displayed in the frontend
        $errorMessage = $e->getMessage();
    }

}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("../components/head.php"); ?>
    <title>vestis. - Einloggen</title>
    <!--Reference to authValidation.js-->
    <script src="../public/js/authValidation.js" defer></script>
</head>
<body>

<!--Header der Website-->
<?php include("../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Formular der Klasse "form-box"-->
    <form class="form-box" id="loginForm" method="post">

        <!--Seitenüberschrift-->
        <h1>
            Einloggen
        </h1>

        <!--Zurückbutton-->
        <?php include("../components/back-btn.php"); ?>

        <?php if (isset($errorMessage)) : ?>
            <h4 class="error-message"><?= $errorMessage ?></h4>
        <?php endif; ?>

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
        <button type="submit" class="btn align-start" id="subBtn">
            login.
        </button>

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
<?php include("../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->