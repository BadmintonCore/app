<?php

use Vestis\Database\Models\GlobalConfig;

/** @var GlobalConfig $config */
?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Konfiguration</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>

    <h1><?= $config->attribute ?></h1>
    <form method="post" class="form-box wide">
        <div class="form-input">
            <label for="value">Wert</label>
            <textarea name="value" id="value" required><?= $config->value ?></textarea>
        </div>
        <button class="btn" type="submit">
            Speichern.
        </button>
    </form>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

