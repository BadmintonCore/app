<?php

use Vestis\Database\Models\ShoppingCart;
use Vestis\Database\Repositories\CategoryRepository;
use Vestis\Database\Repositories\ShoppingCartRepository;
use Vestis\Service\AuthService;
use Vestis\Utility\BreadcrumbsUtility;

$parentCategories = CategoryRepository::findAllWithNoParent();

$account = AuthService::$currentAccount ?? null;
$quantityItems = 0;

if ($account !== null) {
    $syntheticShoppingCart = new ShoppingCart();
    $syntheticShoppingCart->accId = $account->id;
    $syntheticShoppingCart->cartNumber = ShoppingCart::DEFAULT_CART_NUMBER;
    $quantityItems = ShoppingCartRepository::getCountOfItems($syntheticShoppingCart);
}

?>
<header>
    <div class="drawer-toggler" id="sidebarDrawerToggler">
        <!--Grafik von: https://getbootstrap.com/-->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
        </svg>
    </div>
    <nav>
        <ul>
            <?php foreach ($parentCategories as $parentCategory): ?>
                <li><a href="/categories?categoryId=<?= $parentCategory->id ?>"><?= $parentCategory->name ?></a>
                    <?php if (count($parentCategory->getChildCategories()) > 0) : ?>
                        <ul>
                            <?php foreach ($parentCategory->getChildCategories() as $childCategory): ?>
                            <?php
                            $uri = sprintf('/categories?categoryId=%s&%s=%s', $childCategory->id, BreadcrumbsUtility::FIELD_NAME, BreadcrumbsUtility::generateCategoryBreadcrumbsBase64($childCategory));
                                ?>
                            <li><a href="<?= $uri ?>"><?= $childCategory->name ?></a>
                                <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <a class="logo-link" href="/">
        <img class="logo-image" src="/img/logo-transparent.png" alt="vestis.">
    </a>

    <div class="button-row-center">

        <?php if (AuthService::isCustomer()) : ?>
            <!-- Wunschliste-Icon -->
            <a class="header-btn" href="/user-area/wishlist">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                    <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                </svg>
            </a>

            <!-- Warenkorb-Icon -->
            <div class="cart-container">
                <a class="header-btn" href="/user-area/shoppingCart">

                    <!--Grafik von: https://getbootstrap.com/-->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                    </svg>
                </a>

                <?php if ($quantityItems > 0) : ?>
                    <span class="cart-badge">
                    <?= $quantityItems ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Login-Icon -->
            <a class="header-btn" href="/user-area/user">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
            </a>
        <?php elseif (AuthService::isAdmin()) : ?>
            <a class="header-btn" href="/admin">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
            </a>
        <?php else: ?>
            <!-- Login-Icon -->
            <a class="header-btn" href="/auth/login">

                <!--Grafik von: https://getbootstrap.com/-->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
                <span>&nbsp;login.</span>
            </a>
        <?php endif; ?>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="sidebar-drawer" id="sidebarDrawer">

        <!--Grafik von: https://getbootstrap.com/-->
        <svg xmlns="http://www.w3.org/2000/svg" class="close-icon" viewBox="0 0 16 16" id="sidebarClose"
             fill="currentColor">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
        </svg>
        <ul>
            <?php foreach ($parentCategories as $parentCategory): ?>
                <li><a href="/categories?categoryId=<?= $parentCategory->id ?>"><?= $parentCategory->name ?></a>
                    <?php if (count($parentCategory->getChildCategories()) > 0) : ?>
                        <ul>
                            <?php foreach ($parentCategory->getChildCategories() as $childCategory): ?>
                            <?php
                        $uri = sprintf('/categories?categoryId=%s&%s=%s', $childCategory->id, BreadcrumbsUtility::FIELD_NAME, BreadcrumbsUtility::generateCategoryBreadcrumbsBase64($childCategory));
                                ?>
                            <li><a href="<?= $uri ?>"><?= $childCategory->name ?></a>
                                <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="button-row-center">

            <?php if (AuthService::isCustomer()) : ?>
                <!-- Wunschliste-Icon -->
                <a class="header-btn" href="/user-area/wishlist">

                    <!--Grafik von: https://getbootstrap.com/-->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-suit-heart"
                         viewBox="0 0 16 16">
                        <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                    </svg>
                </a>
                <!-- Warenkorb-Icon -->
                <div class="cart-container">
                    <a class="header-btn" href="/user-area/shoppingCart">

                        <!--Grafik von: https://getbootstrap.com/-->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                        </svg>
                    </a>

                    <?php if ($quantityItems > 0) : ?>
                        <span class="cart-badge">
                    <?= $quantityItems ?>
                    </span>
                    <?php endif; ?>
                </div>
                <!-- Login-Icon -->
                <a class="header-btn" href="/user-area/user">

                    <!--Grafik von: https://getbootstrap.com/-->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person"
                         viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                </a>
            <?php elseif (AuthService::isAdmin()) : ?>
                <a class="header-btn" href="/admin">

                    <!--Grafik von: https://getbootstrap.com/-->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person"
                         viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                </a>
            <?php else: ?>
                <!-- Login-Icon -->
                <a class="header-btn" href="/auth/login">

                    <!--Grafik von: https://getbootstrap.com/-->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person"
                         viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>


    <!--Button für Dark-Mode-->
    <button type="button" id="darkModeToggle" class="darkmode-btn">

        <!--Grafik von: https://getbootstrap.com/-->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16">
            <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286"/>
        </svg>

        <!--Grafik von: https://getbootstrap.com/-->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
            <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
        </svg>
    </button>

    <!--Dropdown für Währungs-Selektion-->
    <label for="currency">
        <select name="currency" id="currency" class="currency-select">
            <option value="EUR" selected>&#x1F1E9;&#x1F1EA; EUR</option>
            <option value="CHF">&#x1F1E8;&#x1F1ED; CHF</option>
            <option value="USD">&#x1F1FA;&#x1F1F8; USD</option>
            <option value="KBP">&#x1F959; KBP</option>
        </select>
    </label>
</header>