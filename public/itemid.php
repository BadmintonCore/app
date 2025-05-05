<!-- Author: Mathis Burger -->
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("../components/head.php"); ?>
    <title>Vestis - Produktdetails</title>
</head>
<body>
    <?php include("../components/header.php"); ?>
    <main>
        <div class="details-flex">
            <div class="back-btn-container">
                <?php include("../components/back-btn.php"); ?>
            </div>
            <img src="/img/tshirt-beige.webp"
                 alt="product image"
                 />
            <div class="info">
                <h1>Modernes grünes Tshirt</h1>
                <h5>
                    Ein modernes Tshirt mit guten Look. Perfekt für den Sommer und den Winter. <br/>
                    Passt zu jedem Outfit. Egal ob klassisch, business oder lässig. Mit dem Shirt bist du immer richtig
                    gekleidet.
                </h5>

                <h2 class="price-field">55,00<small>&nbsp;inkl. 19% MwSt.</small></h2>

                <!-- For later submission of the order request -->
                <form class="flex-align-left" id="itemIdForm">
                    <strong>Größe</strong>
                    <div class="flex-row">
                        <label>
                            <input type="radio" name="size" value="xs">
                            XS
                        </label>
                        <label>
                            <input type="radio" name="size" value="s">
                            S
                        </label>
                        <label>
                            <input type="radio" name="size" value="m">
                            M
                        </label>
                        <label>
                            <input type="radio" name="size" value="l">
                            L
                        </label>
                        <label>
                            <input type="radio" name="size" value="xl">
                            XL
                        </label>
                    </div>
                    <strong>Farbe</strong>
                    <div class="flex-row">
                        <label>
                            <input type="radio" name="color" value="lime">
                            Hellgrün
                        </label>
                        <label>
                            <input type="radio" name="color" value="green">
                            Dunkelgrün
                        </label>
                    </div>
                    <label for="amount"><strong>Anzahl</strong></label>
                    <div class="quantity-container">
                        <button class="quantity-btn" type="button">−</button>
                        <input type="number" id="amount" value="1" name="quantity">
                        <button class="quantity-btn" type="button">+</button>
                    </div>
                    <div class="button-row">
                        <button type="submit" class="btn" name="buy_direct">Direkt bestellen</button>
                        <button type="submit" class="btn secondary" name="add_to_cart">Zum Warenkorb hinzufügen</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include("../components/footer.php"); ?>

    <!-- Quantity container event listeners -->
    <script src="/js/quantityContainer.js"></script>
    <!-- Shopping cart helper functions need to be loaded first -->
    <script src="/js/shoppingCart.js"></script>
    <!-- Actual item ID functions -->
    <script src="/js/itemId.js"></script>
    <?php include("../components/scripts.php"); ?>
</body>
</html>
<!-- Author: Mathis Burger -->