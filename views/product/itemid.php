<!-- Author: Mathis Burger -->
<?php
/** @var array<string, string|int>|null $product */
/** @var array<string, string|int>|null $product2 */
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__."/../../components/head.php"); ?>
    <title>Vestis - Produktdetails</title>
</head>
<body>
    <?php include(__DIR__."/../../components/header.php"); ?>
    <main>
        <?php
        /** @var string|null $itemId */
        $itemId = $_GET["itemId"];
if ($itemId === null || trim($itemId) === ""): ?> :
        ?>
            <h1>Parameter nicht gegeben</h1>
        <?php else : ?>
            <?php if ($product !== null) : ?>
                <div class="details-flex">
                    <!--Breadcrumbs-->
                    <?php include("../components/breadcrumbs.php"); ?>

                    <div class="back-btn-container">
                        <?php include(__DIR__."/../../components/back-btn.php"); ?>
                    </div>
                    <img src="/img/tshirt-beige.webp"
                         alt="product image"
                    />
                    <div class="info">
                        <h1 id="nameText"><?= $product["name"] ?></h1>
                        <h5><?= $product["description"] ?></h5>
                        <h2 class="price-field" id="priceText"><?= $product["price"] ?><small class="fee-field">&nbsp;inkl. 19% MwSt.</small></h2>

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
                                <?php
                                    /** @var array<string, string> $product */
                                    $colors = isset($product["color"]) ? explode("/", $product["color"]) : [];
                ?>
                                <?php foreach ($colors as $color) : ?>
                                    <label>
                                        <input type="radio" name="color" value="<?= $color ?>">
                                        <?= $color ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <label for="amount"><strong>Anzahl</strong></label>
                            <div class="quantity-container">
                                <button class="quantity-btn" type="button">−</button>
                                <input type="number" id="amount" value="1" name="quantity">
                                <button class="quantity-btn" type="button">+</button>
                            </div>


                            <button class="wishlist-btn" id="addToWishlistButtonEmpty">

                                <!--Grafik von: https://getbootstrap.com/-->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-suit-heart"
                                     viewBox="0 0 16 16">
                                    <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                </svg>
                            </button>
                            <button class="wishlist-btn" id="addToWishlistButtonFilled">

                                <!--Grafik von: https://getbootstrap.com/-->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-suit-heart-fill"
                                     viewBox="0 0 16 16">
                                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                                </svg>
                            </button>


                            <div class="button-row">
                                <button type="submit" class="btn" name="buy_direct" id="orderButton">Direkt bestellen</button>
                                <button class="btn secondary" id="addToCartButton">Zum Warenkorb hinzufügen</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <h1>Produkt nicht gefunden</h1>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($product2 !== null) : ?>
            <div class="details-flex">
                <div class="back-btn-container">
                    <?php include(__DIR__."/../../components/back-btn.php"); ?>
                </div>
                <img src="/img/tshirt-beige.webp"
                     alt="product image"
                />
                <div class="info">
                    <h1 id="nameText"><?= $product2["name"] ?></h1>
                    <h5><?= $product2["description"] ?></h5>

                    <h2 class="price-field" id="priceText"><?= $product2["price"] ?><small class="fee-field">&nbsp;inkl. 19% MwSt.</small></h2>

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
                            <?php
                            /** @var array<string, string> $product2 */
                            $colors = isset($product2["color"]) ? explode("/", $product2["color"]) : [];
            ?>
                            <?php foreach ($colors as $color) : ?>
                                <label>
                                    <input type="radio" name="color" value="<?= $color ?>">
                                    <?= $color ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <label for="amount"><strong>Anzahl</strong></label>
                        <div class="quantity-container">
                            <button class="quantity-btn" type="button">−</button>
                            <input type="number" id="amount" value="1" name="quantity">
                            <button class="quantity-btn" type="button">+</button>
                        </div>


                        <button class="wishlist-btn" id="addToWishlistButtonEmpty">

                            <!--Grafik von: https://getbootstrap.com/-->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-suit-heart"
                                 viewBox="0 0 16 16">
                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                            </svg>
                        </button>
                        <button class="wishlist-btn" id="addToWishlistButtonFilled">

                            <!--Grafik von: https://getbootstrap.com/-->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-suit-heart-fill"
                                 viewBox="0 0 16 16">
                                <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                            </svg>
                        </button>


                        <div class="button-row">
                            <button type="submit" class="btn" name="buy_direct" id="orderButton">Direkt bestellen</button>
                            <button class="btn secondary" id="addToCartButton">Zum Warenkorb hinzufügen</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <?php include(__DIR__."/../../components/footer.php"); ?>

    <!-- Quantity container event listeners -->
    <script src="/js/quantityContainer.js"></script>
    <!-- Shopping cart helper functions need to be loaded first -->
    <script src="/js/shoppingCart.js"></script>
    <!-- Actual item ID functions -->
    <script src="/js/itemId.js"></script>
    <?php include(__DIR__."/../../components/scripts.php"); ?>
</body>
</html>
<!-- Author: Mathis Burger -->