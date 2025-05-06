<!--Author: Mathis Burger-->

<?php

use Vestis\Database\Repositories\CategoryRepository;

// Loads all categories without a parent category
$categories = CategoryRepository::findAllWithNoParent();
?>

<header>
    <div class="drawer-toggler" id="sidebarDrawerToggler">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
        </svg>
    </div>
    <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li><a href="clothingList.html"><?= $category->name ?></a>
                <?php if (count($category->childCategories) > 0): ?>
                <ul>
                    <?php foreach ($category->childCategories as $childCategory) : ?>
                    <li><a href="shirtsList.php"><?= $childCategory->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <a class="logo-link" href="index.php">
        <img class="logo-image" src="/img/logo-transparent.png" alt="vestis.">
    </a>
    <div class="button-row-center">
        <a class="btn" href="login.php">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            &nbsp;
            login.
        </a>

        <a class="btn" href="shoppingCart.php">

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4"
                 viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
            </svg>
            &nbsp;
            warenkorb.
        </a>

    </div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="sidebar-drawer" id="sidebarDrawer">

        <!--Grafik von: https://getbootstrap.com/-->
        <svg xmlns="http://www.w3.org/2000/svg" class="close-icon" viewBox="0 0 16 16" id="sidebarClose"
             fill="currentColor">
            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
        </svg>
        <ul>
            <li><a href="clothingList.html">Kleidung</a>
                <ul>
                    <li><a href="shirtsList.php">Shirts</a></li>
                    <li><a href="sweaterList.html">Sweater</a></li>
                </ul>
            </li>
            <li><a href="accessoriesList.html">Accessoires</a>
                <ul>
                    <li><a href="capsList.html">Caps</a></li>
                    <li><a href="bagsList.html">Taschen</a></li>
                </ul>
            </li>
        </ul>
        <a class="btn" href="login.php">

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            &nbsp;
            login.
        </a>

        <a class="btn" href="shoppingCart.php">

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4"
                 viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
            </svg>
            &nbsp;
            warenkorb.
        </a>
    </div>
    <!--Author: Mathis Burger-->

    <!--Author: Lasse Hoffmann-->
    <!--Dropdown für Währungs-Selektion-->
    <label for="currency" class="extra-button">
        <select name="currency" id="currency" class="currency-select">
            <option value="EUR" selected>&#x1F1E9;&#x1F1EA; EUR</option>
            <option value="CHF">&#x1F1E8;&#x1F1ED; CHF</option>
            <option value="USD">&#x1F1FA;&#x1F1F8; USD</option>
            <option value="KBP">&#x1F959; KBP</option>
        </select>
    </label>
    <!--Author: Lasse Hoffmann-->

    <!--Author: Lennart Moog-->
    <!--Button für Dark-Mode-->
    <div class="extra-button">
        <button type="button" id="darkModeToggle" class="darkmode-btn" onclick="toggleDarkMode()">

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-moon" viewBox="0 0 16 16">
                <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286"/>
            </svg>

            <!--Grafik von: https://getbootstrap.com/-->
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-sun" viewBox="0 0 16 16">
                <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6m0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
            </svg>
        </button>
    </div>
</header>
<!--Author: Lennart Moog-->