<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../components/head.php"); ?>
    <title>vestis. - Startseite</title>
</head>
<body>
<?php include(__DIR__."/../components/header.php"); ?>

<main class="banner-content">
    <div>
        <img src="/img/index-banner.png" alt="Banner" class="banner-image">
    </div>

    <h1>Unsere Bestseller!</h1>
    <div class="card-flex p-5">
        <?php include(__DIR__."/../components/productCards.php"); ?>
    </div>
</main>

<?php include(__DIR__."/../components/footer.php"); ?>
<?php include(__DIR__."/../components/cookieCheck.php"); ?>
<?php include(__DIR__."/../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog-->