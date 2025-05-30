<?php
/** @var string $errorMessage */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../components/head.php"); ?>
    <title>vestis. - Fehler</title>
</head>
<body>
<?php include(__DIR__."/../components/header.php"); ?>

<main>
    <h1 class="error-message">Fehler!</h1>
    <h3 class="error-message"><?= $errorMessage ?></h3>
</main>

<?php include(__DIR__."/../components/footer.php"); ?>
<?php include(__DIR__."/../components/scripts.php"); ?>
</body>
</html>
