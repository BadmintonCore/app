<!--Autor(en): Lasse Hoffmann-->
<?php

use Vestis\Database\Models\Image;

/** @var Image|null $image */

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Bilder</title>
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

    <?php if (isset($errorMessage)): ?>
        <h1 class="error-message"><?= $errorMessage ?></h1>
    <?php endif; ?>
    
    <?php if ($image !== null): ?>
    <h1><?= $image->name ?></h1>
    <img src="<?= $image->path ?>" alt="<?= $image->name ?>">
    <?php endif; ?>
    

</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Autor(en): Lasse Hoffmann-->