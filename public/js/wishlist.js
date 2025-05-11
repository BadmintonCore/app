/**
 * @author Lasse Hoffmann
 */

const wishlistButtonEmpty = document.getElementById('addToWishlistButtonEmpty');
const wishlistButtonFilled = document.getElementById('addToWishlistButtonFilled');

wishlistButtonEmpty.addEventListener("click", function () {
    wishlistButtonEmpty.style.display = "none";
    wishlistButtonFilled.style.display = "flex";
});

wishlistButtonFilled.addEventListener("click", function () {
    wishlistButtonFilled.style.display = "none";
    wishlistButtonEmpty.style.display = "flex";
});

function loadWishlistButton() {
    const searchParams = new URLSearchParams(location.search);
    if (isWishlist(searchParams.get('itemId'))) {
        wishlistButtonFilled.style.display = "flex";
        wishlistButtonEmpty.style.display = "none";
    } else {
        wishlistButtonEmpty.style.display = "flex";
        wishlistButtonFilled.style.display = "none";
    }
}

function isWishlist(productId) {
    return getItemFromWishlist(productId) !== undefined;
}

/**
 * JSDoc type definition for shopping cart item.
 *
 * @typedef {Object} WishlistItem
 * @property {string} productName The name of the product
 * @property {number} productPrice The price of the product
 * @property {number} quantity The quantity of the product
 */

/**
 * Gets the shopping cart from browsers local storage.
 *
 * @returns {Record<string, WishlistItem>}
 */
function getWishlist() {
    const rawWishlistContent = localStorage.getItem("wishlist") ?? '{}';
    return JSON.parse(rawWishlistContent);
}


/**
 * Gets an item from the current shopping cart stored in browsers local storage.
 *
 * @param {number} productId The ID of the product that should be loaded from the shopping cart
 *
 * @returns {(WishlistItem|undefined)} Gets a product from the shopping cart. Undefined if the item does not exist.
 */
function getItemFromWishlist(productId) {
    const wishlist = getWishlist();
    console.log(wishlist, productId);
    return wishlist[`${productId}`]
}

/**
 * Adds an item to the shopping cart.
 *
 * @param {number} productId The ID of the product
 * @param {string} productName The name of the product
 * @param {number} productPrice The price of a single product
 */
function addToWishlist(productId, productName, productPrice) {
    const wishlistItem = getItemFromWishlist(productId) ?? {productName, productPrice};
    wishlistItem.addedDate = new Date().toISOString();
    const Wishlist = getWishlist();
    Wishlist[`${productId}`] = wishlistItem;
    localStorage.setItem("wishlist", JSON.stringify(Wishlist));
}

/**
 * Removes a product from the shopping cart
 *
 * @param {number} productId The ID of the product
 */
function removeFromWishlist(productId) {
    const Wishlist = getWishlist();
    delete Wishlist[productId];
    localStorage.setItem("wishlist", JSON.stringify(Wishlist));
    renderWishlist();
}

/**
 * Calculates the total price with tax included.
 *
 * @param {number} price The price without tax
 * @returns {number} The price with tax
 */
function getTotalPrice(price) {
    return price * 1.19;
}

/**
 * Renders the shopping cart into the table and calculates the final total prices.
 */
function renderWishlist() {
    const tableBody = document.getElementById("WishlistTBody");
    tableBody.innerHTML = '';
    const Wishlist = getWishlist();
    for (const [productId, WishlistItem] of Object.entries(Wishlist)) {
        const row = document.createElement("tr");

        const nameTd = document.createElement("td");
        nameTd.textContent = WishlistItem.productName;
        row.appendChild(nameTd);

        const priceId = document.createElement("td");
        priceId.classList.add("price-field");
        priceId.textContent = `${getTotalPrice(WishlistItem.productPrice).toFixed(2)}€`;
        row.appendChild(priceId);

        // Neue Spalte für das Hinzufügedatum (nur Datum ohne Uhrzeit)
        const dateAddedTd = document.createElement("td");
        const dateAdded = new Date(WishlistItem.addedDate);
        // Formatierung des Datums (nur DD.MM.YYYY)
        dateAddedTd.textContent = `${("0" + dateAdded.getDate()).slice(-2)}.${("0" + (dateAdded.getMonth() + 1)).slice(-2)}.${dateAdded.getFullYear()}`;  // Nur das Datum anzeigen
        row.appendChild(dateAddedTd);

        const toShoppingCartTd = document.createElement("td");
        const toShoppingCartButton = document.createElement("button");
        toShoppingCartButton.textContent = 'zum warenkorb.';
        toShoppingCartButton.className = "btn btn-sm";
        toShoppingCartButton.addEventListener("click", () => addToShoppingCart(productId, productName, productPrice, quantity));
        toShoppingCartTd.appendChild(toShoppingCartButton);
        row.appendChild(toShoppingCartTd);

        const actionsTd = document.createElement("td");
        const removeButton = document.createElement("button");
        removeButton.textContent = 'entfernen.';
        removeButton.className = "btn btn-sm danger";
        removeButton.addEventListener("click", () => removeFromWishlist(productId));
        actionsTd.appendChild(removeButton);
        row.appendChild(actionsTd);

        tableBody.appendChild(row);
    }
    updatePrices();
}

loadWishlistButton();