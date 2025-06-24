<!--Autor(en): Lennart Moog-->
<?php

use Vestis\Database\Models\Color;

/** @var Color|null $color */
/** @var string|null $errorMessage */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Farben</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>
    <h1>Farbe erstellen</h1>
    <form method="post" class="form-box">
        <?php if (isset($errorMessage)): ?>
            <div class="error-message"><?= $errorMessage ?></div>
        <?php endif; ?>
        <div class="form-input">
            <label for="name">Name der Farbe</label>
            <input name="name" id="name" required />
        </div>
        <div class="form-input">
            <label for="hex">Farbe</label>
            <input type="color" name="hex" id="hex" required />
        </div>
        <button class="btn" type="submit">
            Erstellen.
        </button>
    </form>

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Autor(en): Lennart Moog-->