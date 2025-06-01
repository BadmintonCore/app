<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php use Vestis\Service\AuthService;

    include(__DIR__ . "/../../components/head.php"); ?>
    <title>vestis. - Logout</title>
</head>

<!--Header der Website-->
<?php include(__DIR__ . "/../../components/header.php"); ?>

<!--Inhalt der Seite-->
<main>
    <!--Zurück-Button-->
    <?php include(__DIR__ . "/../../components/back-btn.php"); ?>

    <h1><span id="name"></span></h1>
    <p class="large-text">
        Du hast dich erfolgreich abgemeldet. <br>
        Vielen Dank und bis zum nächsten Mal.
    </p>

    <script>
        var lastUsername = sessionStorage.getItem("lastUsername");
        var greeting = lastUsername ? "Bis bald, " + lastUsername + " 👋" : "Auf Wiedersehen 👋"
        document.getElementById("name").innerHTML = greeting;
    </script>
</main>

<!--Footer der Website-->
<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/cookieCheck.php"); ?>
<?php include(__DIR__ . "/../../components/scripts.php"); ?>


</html>
<!--Author: Lennart Moog-->