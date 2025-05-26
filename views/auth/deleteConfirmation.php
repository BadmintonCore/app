<!--Author: Lasse Hoffmann-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__ . "/../../components/head.php"); ?>
    <title>vestis. - Account löschen</title>
</head>

<!--Header der Website-->
<?php include(__DIR__ . "/../../components/header.php"); ?>

<main>

    <form class="form-box" id="deleteForm" method="post">

        <h1>Account löschen</h1>
        <?php include(__DIR__ . "/../../components/back-btn.php"); ?>

        <?php if (isset($errorMessage)) : ?>
            <h4 class="error-message"><?= $errorMessage ?></h4>
        <?php endif; ?>

        <h3 id="deleteAccount"></h3>

        <script>
            document.getElementById("deleteAccount").innerHTML = "Bist du sicher, dass du deinen Account löschen möchtest, " + sessionStorage.getItem("lastUsername") + "?";
        </script>

        <div class="button-row-center">
            <button type="submit" class="btn danger">
                Account löschen
            </button>

            <a href="/" class="btn secondary">
                Account behalten
            </a>
        </div>

    </form>
</main>

<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__ . "/../../components/scripts.php"); ?>
</html>
<!--Author: Lasse Hoffmann-->