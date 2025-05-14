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
    <script src="/js/authValidation.js" defer></script>
    <!--Defer: JavaScript wird erst ausgeführt, wenn HTML-Seite fertig geparst ist
    Alternative: Script am Ende vom body erst aufführen-->
</head>

<!--Header der Website-->
<?php include(__DIR__."/../../components/header.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <form class="form-box" id="userForm">

        <h1>Benutzerbereich</h1>
        <?php include(__DIR__."/../../components/back-btn.php"); ?>

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
        <button id="toggle-breadcrumbs" class="btn" type="button" >Breadcrumbs ausblenden</button>
    </form>
</main>
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</html>
<!--Author: Lennart Moog-->