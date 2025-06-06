<?php

use Vestis\Database\Models\Category;
use Vestis\Database\Models\Color;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\Size;

/** @var ProductType $productType */
?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Warenkörbe</title>
    <?php include(__DIR__."/../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__."/../../components/header.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__."/../../components/breadcrumbs.php"); ?>

    <h1>Warenkorb erstellen</h1>
    <form method="post" class="form-box">
        <div class="form-input">
            <label for="name">Name</label>
            <input name="name" type="text" id="name" required />
        </div>
        <div class="form-input">
            <label for="shared">Geteilt?</label>
            <input name="isShared" type="checkbox" id="shared" />
        </div>
        <button class="btn" type="submit">
            Speichern.
        </button>
    </form>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../components/footer.php"); ?>
<?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

