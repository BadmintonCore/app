<?php
/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
?>
<?php

use Vestis\Database\Models\Order;

/** @var Order $order */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Auftrag</title>
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

        <h1>Auftrag <?= $order->id ?></h1>
        <form method="post" class="form-box">
            <div class="form-input">
                <label for="reason">Grund</label>
                <textarea required name="reason" id="reason"></textarea>
            </div>
            <button class="btn" type="submit">
                Ablehnen.
            </button>
        </form>
</main>

<!--Footer der Website-->
<?php include(__DIR__."/../../../components/adminFooter.php"); ?>
<?php include(__DIR__."/../../../components/scripts.php"); ?>
</body>
</html>