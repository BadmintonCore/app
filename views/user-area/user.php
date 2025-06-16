<!--Author: Lennart Moog-->
<?php

use Vestis\Service\AuthService;

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__ . "/../../components/head.php"); ?>
    <title>vestis. - Benutzerbereich</title>
    <script src="/js/authValidation.js" defer></script>
</head>

<!--Header der Website-->
<?php AuthService::isAdmin() ? include(__DIR__ . "/../../components/adminHeader.php") : include(__DIR__ . "/../../components/header.php"); ?>

<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <form class="form-box" id="userForm" method="post">

        <?php if (AuthService::isCustomer()): ?>
        <div class="button-row justify-center">
            <a href="/user-area/orders" class="btn btn-sm">Aufträge.</a>
            <a href="/user-area/shoppingCarts" class="btn btn-sm">Warenkörbe.</a>
        </div>
        <?php endif; ?>

        <h1>Benutzerbereich</h1>

        <!--Zurückbutton-->
        <a class="back-btn" id="backButton" href="/../../">
            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            <span>Zurück</span>
        </a>

        <?php if (isset($errorMessage)) : ?>
            <h4 class="error-message"><?= $errorMessage ?></h4>
        <?php endif; ?>

        <script>
            const firstname = "<?= AuthService::$currentAccount?->firstname ?>";
        </script>

        <h3 id="userTypeWriter"><span id="welcomeTextField"></span> </h3>


        <div class="form-input">
            <label for="username"><b>Benutzername</b></label>
            <input type="text" id="username" name="username" value="<?= AuthService::$currentAccount?->username ?>"
                   required>
        </div>
        <div class="form-input">
            <label for="email"><b>E-Mail</b></label>
            <input type="email" id="email" name="email" value="<?= AuthService::$currentAccount?->email ?>" required>
        </div>
        <div class="form-input">
            <label for="password">
                <b>Neues Passwort<sup>*</sup></b>
            </label>

            <!--Input für das Passwort-->
            <input type="password" id="password" placeholder="Passwort eingeben" name="password" required>
        </div>
        <div class="form-input">
            <label for="passwordConfirmation">
                <b>Neues Passwort wiederholen<sup>*</sup></b>
            </label>

            <!--Input für das Passwort-->
            <input type="password" id="passwordConfirmation" placeholder="Passwort eingeben" name="passwordConfirmation"
                   required>
        </div>

        <button type="submit" class="btn align-start" id="subBtn">
            aktualisieren.
        </button>

        <a href="/auth/logout" class="btn align-start">
            logout.
        </a>

        <button id="toggle-breadcrumbs" class="btn" type="button" >Breadcrumbs ausblenden</button>

        <a href="/auth/deleteConfirmation" class="btn secondary align start">Account löschen</a>
    </form>
    <script>
        sessionStorage.setItem("lastUsername", <?php echo json_encode(AuthService::$currentAccount?->firstname)?>);
    </script>
</main>

<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__ . "/../../components/scripts.php"); ?>
<script src="/js/authValidation.js" defer></script>
<script src="/js/emojiRandomizer.js"></script>
<script src="/js/textRandomizer.js"></script>
<script src="/js/userTypeWriter.js"></script>
</html>
<!--Author: Lennart Moog-->