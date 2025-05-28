<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Kategorien</title>
    <?php include(__DIR__."/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../../components/breadcrumbs.php"); ?>
    <?php if (isset($errorMessage)): ?>
    <h1><?= $errorMessage ?></h1>
    <?php else: ?>
    <h1>Farbe erstellen</h1>
    <form method="post" class="form-box">
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
    <?php endif; ?>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/footer.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

