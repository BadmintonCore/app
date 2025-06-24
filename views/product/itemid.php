<!-- Autor(en): Mathis Burger -->
<?php

use Vestis\Database\Models\ProductReview;
use Vestis\Database\Models\ProductType;
use Vestis\Database\Models\ShoppingCart;
use Vestis\Database\Repositories\ReviewRepository;
use Vestis\Service\AuthService;

/** @var ProductType|null $product */
/** @var string|null $errorMessage */
/** @var ShoppingCart[] $shoppingCarts */
/** @var float $averageRating */
/** @var int $reviewCount */
/** @var bool $hasReviewed */
/** @var ProductReview[] $reviews */

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include(__DIR__ . "/../../components/head.php"); ?>
    <title>Vestis - Produktdetails</title>
</head>
<body>
<?php include(__DIR__ . "/../../components/header.php"); ?>
<main>

    <noscript>
        <div id="noscript-warning" style="display: block; color: red; text-align: center;">
            JavaScript ist deaktiviert! Bitte aktivieren Sie JavaScript, um die Seite korrekt anzuzeigen.
        </div>
    </noscript>


    <?php if ($product !== null && $errorMessage === null) : ?>
        <div class="details-flex">
            <!--Breadcrumbs-->
            <?php include(__DIR__ . "/../../components/breadcrumbs.php"); ?>

            <?php if (count($product->getImages()) > 0) : ?>
                <div class="carousel">
                    <div class="carousel-track">
                        <?php foreach ($product->getImages() as $image) : ?>
                            <img src="<?= $image->path ?>" alt="<?= $image->name ?>" class="carousel-image"/>
                        <?php endforeach; ?>
                    </div>
                    <div class="button-row">
                        <button class="prev">&#10094;</button>
                        <button class="next">&#10095;</button>
                    </div>
                </div>
            <?php endif; ?>


            <div class="info">
                <div class="flex-row-align-center">
                    <h1 id="nameText" class="centered" style="margin: 0;"><?= $product->name ?></h1>
                    <?php if ($averageRating > 0): ?>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--accent-color)" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                <a href="#reviews" class="rating-link" style="text-decoration: none; color: inherit;">
                                <?= $averageRating ?> (<?= $reviewCount ?>)
                            </span>
                        </a>



                    <?php endif; ?>

                </div>

                <h5><?= $product->description ?></h5>
                <h2 class="price-field with-discount" id="priceText">
                    <?= $product->getDiscountedPrice() ?>
                    <?php if ($product->discount > 0) : ?>
                    <div class="discount-badge sm">-<?= $product->discount * 100 ?>%</div>
                    <?php endif; ?>
                    <small class="fee-field">&nbsp;inkl. 19% MwSt.</small></h2>

                <!-- Form für die Wishlist/Warenkorb/Order -->
                <form class="flex-align-left" id="itemIdForm" method="post">
                    <strong>Größe</strong>
                    <div class="flex-row">
                        <?php foreach ($product->getSizes() as $size) : ?>
                            <label>
                                <input type="radio" name="size" value="<?= $size->id ?>">
                                <?= $size->size ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <strong>Farbe</strong>
                    <div class="flex-row">
                        <?php foreach ($product->getColors() as $color) : ?>
                            <label>
                                <input
                                        type="radio"
                                        name="color"
                                        value="<?= $color->id ?>"
                                >
                                <?= $color->name ?>
                                &nbsp;
                                <div class="color-circle" style="background: #<?= $color->hex ?>"></div>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <?php if (AuthService::$currentAccount === null): ?>

                        <div class="button-row">
                            <a href="/auth/login" class="btn" id="orderButton">
                                Einloggen, um zu bestellen
                            </a>
                        </div>

                    <?php else: ?>

                        <?php if (AuthService::isCustomer()) : ?>

                            <button type="button" class="wishlist-btn" id="addToWishlistButtonEmpty"
                                    onclick="addToWishlist(<?= $product->id ?>)">

                                <!--Grafik von: https://getbootstrap.com/-->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-suit-heart"
                                     viewBox="0 0 16 16">
                                    <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                </svg>
                            </button>

                            <button type="button" class="wishlist-btn" id="addToWishlistButtonFilled"
                                    onclick="removeFromWishlist(<?= $product->id ?>)">

                                <!--Grafik von: https://getbootstrap.com/-->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                     class="bi bi-suit-heart-fill"
                                     viewBox="0 0 16 16">
                                    <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1"/>
                                </svg>
                            </button>

                            <div id="quantityLeft"></div>

                            <label for="amount" id="quantityLabel" style="display: none"><strong>Anzahl</strong></label>
                            <div class="quantity-container" style="display: none">
                                <button class="quantity-btn" type="button">−</button>
                                <input type="number" id="amount" value="1" name="quantity" readonly>
                                <button class="quantity-btn" type="button">+</button>
                            </div>

                            <div class="button-row">
                                <select id="shoppingCartSelect" name="shoppingCart" class="retro width-auto"
                                        style="display: none">
                                    <?php foreach ($shoppingCarts as $shoppingCart) : ?>
                                        <option value="<?= $shoppingCart->accId ?>-<?= $shoppingCart->cartNumber ?>"><?= $shoppingCart->name ?? "Standard" ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn" id="orderButton" name="buyDirect"
                                        style="display: none">
                                    Direkt bestellen
                                </button>
                                <button type="submit" class="btn secondary" id="addToCartButton" style="display: none">
                                    Zum Warenkorb hinzufügen
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if (AuthService::isAdmin()) : ?>
                            <div class="error-message">Du hast ein Administratoren-Konto. Du hast keinen Zugang zu
                                Warenkörben.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </form>
            </div>

            <div class="stack align-center">
                <h2>Weitere Angaben</h2>
                <table>
                    <tr>
                        <td>Material</td>
                        <td><?= $product->material ?></td>
                    </tr>
                    <tr>
                        <td>Kollektion</td>
                        <td><?= $product->collection ?></td>
                    </tr>
                    <tr>
                        <td>Waschanweisungen</td>
                        <td><?= $product->careInstructions ?></td>
                    </tr>
                    <tr>
                        <td>Herkunft</td>
                        <td><?= $product->origin ?></td>
                    </tr>
                    <?php
                            /** @var array<string, int|float|string> $extraFields */
                            $extraFields = json_decode($product->extraFields, true);

?>
                    <?php foreach (array_keys($extraFields) as $field): ?>
                        <tr>
                            <td><?= $field ?></td>
                            <td><?= $extraFields[$field] ?> </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <?php if (AuthService::$currentAccount === null): ?>
                    <div class="form-box">
                        <h2>Bewerten Sie dieses Produkt</h2>
                        <p>Bitte <a href="/auth/login">loggen Sie sich ein</a>, um eine Bewertung abzugeben.</p>
                    </div>

                <?php elseif ($hasReviewed): ?>
                    <div class="form-box">
                        <h2>Vielen Dank für deine Bewertung!</h2>
                        <p>Du hast dieses Produkt bereits bewertet.</p>
                    </div>

                <?php else: ?>
                    <div class="form-box">
                    <h2>Bewerten Sie dieses Produkt</h2>
                    <form id="contactForm" method="post" action="/categories/product/postReview">
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">

                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5" title="5 Sterne">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>

                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 Sterne">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>

                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 Sterne">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>

                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="2 Sterne">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>

                            </label>

                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="1 Stern">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </label>
                        </div>


                        <label for="review"><strong>Ihre Rezension:</strong></label>
                        <textarea name="review" id="review" rows="4" class="review-form" placeholder="Was hat Ihnen gefallen?"></textarea>

                        <button class="btn" type="submit" name="submitReview">Bewertung senden</button>

                    </form>
                </div>

<?php endif; ?>
                <?php if (count($reviews) > 0): ?>
                    <div id="reviews" class="review-list form-box">
                        <h2>Das sagen unsere Kunden:</h2>
                        <?php foreach ($reviews as $review): ?>
                            <div class="single-review">
                                <strong><?= $review->getUser()->firstname ?> <?= $review->getUser()->surname ?>
                                        <?php if ($review->isVerified()): ?>
                                    <span> Verified</span>
                                        <?php endif; ?>
                                    </strong>
                                <?php
                                    $timestamp = strtotime($review->created_at);
                            if ($timestamp === false) {
                                $timestamp = time();
                            }
                            ?>
                                <small><?= date("d.m.Y", $timestamp) ?></small>
                                <div class="stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= $review->rating): ?>
                                            <!-- Gefüllter Stern -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        <?php else: ?>
                                            <!-- Leerer Stern -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                            </svg>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <p><?= $review->review ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="form-box">
                        <h2>Keine Bewertungen vorhanden</h2>
                        <p>Sei der Erste, der dieses Produkt bewertet!</p>
                    </div>
                <?php endif; ?>


                <?php else : ?>
        <h1><?= $errorMessage ?></h1>
    <?php endif; ?>
</main>

<?php include(__DIR__ . "/../../components/footer.php"); ?>
<?php include(__DIR__ . "/../../components/cookieCheck.php"); ?>

<!-- JavaScript für den quantity-container-->
<script src="/js/quantityContainer.js"></script>

<!-- JavaScript für den Warenkorb-submit-->
<script src="/js/shoppingCart.js"></script>


<?php include(__DIR__ . "/../../components/scripts.php"); ?>
</body>
</html>
<!-- Autor(en): Mathis Burger -->