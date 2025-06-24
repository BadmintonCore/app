<!--Autor(en): Mathis Burger-->
<?php
/** @var ProductType[] $products */

use Vestis\Database\Models\ProductType;
use Vestis\Utility\BreadcrumbsUtility;

foreach ($products as $product) : ?>
    <?php

    $uri = sprintf(
        "/categories/product?itemId=%s&%s=%s",
        $product->id,
        BreadcrumbsUtility::FIELD_NAME,
        BreadcrumbsUtility::generateProductBreadcrumbsBase64($product->getCategory(), $product)
    );
    ?>
    <div class="card product-card">
        <div class="img-placeholder">
            <?php if (count($product->getImages()) > 0): ?>
                <img
                    src="<?= $product->getImages()[0]->path ?>"
                    alt="<?= $product->name ?>"/>
            <?php endif; ?>
        </div>
        <br>
        <h2><a href="<?= $uri ?>"><?= $product->name ?></a></h2>
        <h4 class="price-field with-discount">
            <?= $product->getDiscountedPrice() ?> €
            <?php if ($product->discount > 0): ?>
                <div class="discount-badge">-<?=$product->discount * 100 ?>%</div>
            <?php endif; ?>
        </h4>
        <a href="<?= $uri ?>" class="btn btn-sm">details.</a>
    </div>
<?php endforeach; ?>
<!--Autor(en): Mathis Burger-->
