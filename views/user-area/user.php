<!--Author: Lennart Moog-->
<?php

use Vestis\Service\AuthService;

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__ . "/../../components/head.php"); ?>
    <title>vestis. - Benutzerbereich</title>

    <!--Reference to authValidation.js-->
    <script src="/js/authValidation.js" defer></script>
    <!--Defer: JavaScript wird erst ausgeführt, wenn HTML-Seite fertig geparst ist
    Alternative: Script am Ende vom body erst aufführen-->
</head>

<!--Header der Website-->
<?php include(__DIR__ . "/../../components/header.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <form class="form-box" id="userForm" method="post">

        <h1>Benutzerbereich</h1>
        <?php include(__DIR__ . "/../../components/back-btn.php"); ?>

        <?php if (isset($errorMessage)) : ?>
            <h4 class="error-message"><?= $errorMessage ?></h4>
        <?php endif; ?>

        <h3><span id="welcomeTextField"></span> <?= AuthService::$currentAccount?->firstname ?> <span
                    id="emojiField"></span>!</h3>

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
<?php include(__DIR__ . "/../../components/scripts.php"); ?>
<script src="/js/authValidation.js" defer></script>
<script src="/js/emojiRandomizer.js"></script>
<script src="/js/textRandomizer.js"></script>
</html>
<!--Author: Lennart Moog-->