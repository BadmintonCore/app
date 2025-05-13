<!--Author: Lennart Moog-->
<?php
use Vestis\Service\AuthService;

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>vestis. - Benutzerbereich</title>

    <!--Reference to authValidation.js-->
    <script src="../../public/js/authValidation.js" defer></script>
    <!--Defer: JavaScript wird erst ausgeführt, wenn HTML-Seite fertig geparst ist
    Alternative: Script am Ende vom body erst aufführen-->
</head>

<!--Header der Website-->
<?php include(__DIR__."/../../components/header.php"); ?>

<main>

    <form class="form-box" id="userForm">

        <h1>Benutzerbereich</h1>
        <?php include(__DIR__."/../../components/back-btn.php"); ?>

        <h3><span id="welcomeTextField"></span> <?= AuthService::$currentAccount?->firstname?> <span id="emojiField"></span>!</h3>

        <div class="form-input">
            <label for="username"><b>Benutzername</b></label>
            <input type="text" id="username" name="username" value="<?= AuthService::$currentAccount?->username ?>" required>
        </div>
        <br/>
        <div class="form-input">
            <label for="email"><b>E-Mail</b></label>
            <input type="email" id="email" name="email" value="<?= AuthService::$currentAccount?->email ?>" required>
        </div>
        <br/>
        <br/>
        <button type="submit" class="btn align-start" id="subBtn" disabled>
            aktualisieren.
        </button>
        <br/>
        <br/>
        <a href="/auth/logout" class="btn align-start">
            logout.
        </a>
    </form>
</main>
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
<script src="/js/authValidation.js" defer></script>
<script src="/js/emojiRandomizer.js"></script>
<script src="/js/textRandomizer.js"></script>
</html>
<!--Author: Lennart Moog-->