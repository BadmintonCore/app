<!-- Author: Mathis Burger -->


<?php
$categories = ["bag", "cap", "shirt", "sweater"];
$mergedContent = [];
foreach ($categories as $category) {
    $filePath = sprintf("../json/%s.json", $category);
    $jsonContent = json_decode(file_get_contents($filePath), true);
    $mergedContent = array_merge($mergedContent, $jsonContent[$category]);
}

if (!empty($_GET["itemId"])) {
    $itemId = intval($_GET["itemId"]);
    $product = array_find($mergedContent, fn ($item) => $item["pid"] === $itemId);
}

if (!empty($_GET["itemId2"])) {
    $itemId = intval($_GET["itemId2"]);
    $product2 = array_find($mergedContent, fn ($item) => $item["pid"] === $itemId);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("../components/head.php"); ?>
    <title>Vestis - Produktdetails</title>
</head>
<body>
    <?php include("../components/header.php"); ?>
    <main>
        <?php if (empty($_GET["itemId"])) : ?>
            <h1>Parameter nicht gegeben</h1>
        <?php else : ?>
            <?php if ($product !== null) : ?>
                <div class="details-flex">
                    <div class="back-btn-container">
                        <?php include("../components/back-btn.php"); ?>
                    </div>
                    <img src="/img/tshirt-beige.webp"
                         alt="product image"
                    />
                    <div class="info">
                        <h1><?= $product["name"] ?></h1>
                        <h5><?= $product["description"] ?></h5>

                        <h2 class="price-field"><?= $product["price"] ?><small class="fee-field">&nbsp;inkl. 19% MwSt.</small></h2>

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
                                $colors = $product["color"] ? explode("/", $product["color"]) : [];
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
                            <div class="button-row">
                                <button type="submit" class="btn" name="buy_direct" id="orderButton">Direkt bestellen</button>
                                <button type="submit" class="btn secondary" name="add_to_cart" id="addToCartButton">Zum Warenkorb hinzufügen</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else : ?>
                <h1>Produkt nicht gefunden</h1>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (isset($product2) && $product2 !== null) : ?>
            <div class="details-flex">
                <div class="back-btn-container">
                    <?php include("../components/back-btn.php"); ?>
                </div>
                <img src="/img/tshirt-beige.webp"
                     alt="product image"
                />
                <div class="info">
                    <h1><?= $product2["name"] ?></h1>
                    <h5><?= $product2["description"] ?></h5>

                    <h2 class="price-field"><?= $product2["price"] ?><small class="fee-field">&nbsp;inkl. 19% MwSt.</small></h2>

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
                            $colors = $product2["color"] ? explode("/", $product2["color"]) : [];
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
                        <div class="button-row">
                            <button type="submit" class="btn" name="buy_direct" id="orderButton">Direkt bestellen</button>
                            <button type="submit" class="btn secondary" name="add_to_cart" id="addToCartButton">Zum Warenkorb hinzufügen</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <?php include("../components/footer.php"); ?>

    <!-- Quantity container event listeners -->
    <script src="/js/quantityContainer.js"></script>
    <!-- Shopping cart helper functions need to be loaded first -->
    <script src="/js/shoppingCart.js"></script>
    <!-- Actual item ID functions -->
    <script>
        function handleFormSubmit(e) {
            e.preventDefault();
            const formData = new FormData(e.currentTarget);
            const action = e.submitter.name;
            if (action === "buy_direct") {
                alert("Direktkäufe sind noch nicht möglich");
                return;
            }
            const quantity = formData.get("quantity");
            if (action === "add_to_cart" && typeof quantity === "string") {
                addToShoppingCart(<?= $product["pid"] ?>, "<?= $product["name"] ?>", <?= $product["price"] ?> / 1.19, parseInt(quantity, 10));
                alert("Produkt erfolgreich dem Warenkorb hinzugefügt");
            }
        }

        document.getElementById("itemIdForm").addEventListener("submit", handleFormSubmit);
    </script>
    <?php include("../components/scripts.php"); ?>
</body>
</html>
<!-- Author: Mathis Burger -->