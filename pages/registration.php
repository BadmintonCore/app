<!--Author: Lasse Hoffmann-->

<?php

use Vestis\Database\Models\AccountType;
use Vestis\Database\Repositories\AccountRepository;
use Vestis\Exception\EmailException;
use Vestis\Exception\ValidationException;
use Vestis\Service\EmailService;
use Vestis\Service\validation\ValidationRule;
use Vestis\Service\validation\ValidationType;
use Vestis\Service\ValidationService;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $validationRules = [
            'firstName' => new ValidationRule(ValidationType::String),
            'surname' => new ValidationRule(ValidationType::String),
            'username' => new ValidationRule(ValidationType::String),
            'email' => new ValidationRule(ValidationType::Email),
            'password' => new ValidationRule(ValidationType::String),
            'newsletter' => new ValidationRule(ValidationType::Boolean, true),
        ];
    try {
        ValidationService::validateForm($validationRules);
        $account = AccountRepository::create(AccountType::Customer ,$_POST['firstName'], $_POST['surname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['newsletter'] ?? false);
        EmailService::sendRegistrationConfirmation($account);
    } catch (ValidationException|EmailException $e) {
        $validationError = $e->getMessage();
    }
} else {
    EmailService::sendRegistrationConfirmation(AccountRepository::findByUsername("lassehoff"));
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("../components/head.php"); ?>
    <title>vestis. - Registrieren</title>

    <!--Reference to authValidation.js-->
    <script src="../public/js/authValidation.js" defer></script>
    <!--Defer: JavaScript wird erst ausgeführt, wenn HTML-Seite fertig geparst ist
    Alternative: Script am Ende vom body erst aufführen-->
</head>
<body>

<!--Header der Website-->
<?php include("../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>

    <!--Formular der Klasse "form-box"-->
    <form class="form-box" id="registrationForm" method="post">

        <!--Seitenüberschrift-->
        <h1>
            Registrieren
        </h1>

        <?php if (isset($validationError)) : ?>
            <p><?= $validationError ?></p>
        <?php endif; ?>

        <!--Zurückbutton-->
        <?php include("../components/back-btn.php"); ?>

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
                <p>Ich habe die <u><a href="gtc.php">AGBs</a></u> gelesen und akzeptiere diese<sup>*</sup></p>
            </label>
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
            <button type="submit" class="btn" id="subBtn">
                registrieren.
            </button>
        </div>
    </form>
</main>

<!--Footer der Website-->
<?php include("../components/footer.php"); ?>
<?php include("../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lasse Hoffmann-->