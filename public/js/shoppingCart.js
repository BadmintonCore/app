/**
 * @author Mathis Burger
 */

/**
 * JSDoc type definition for shopping cart item.
 *
 * @typedef {Object} ShoppingCartItem
 * @property {string} productName The name of the product
 * @property {number} productPrice The price of the product
 * @property {number} quantity The quantity of the product
 */

/**
 * Gets the shopping cart from browsers local storage.
 *
 * @returns {Record<string, ShoppingCartItem>}
 */
function getShoppingCart() {
    const rawShoppingCartContent = localStorage.getItem("shopping-cart") ?? '{}';
    return JSON.parse(rawShoppingCartContent);
}


/**
 * Gets an item from the current shopping cart stored in browsers local storage.
 *
 * @param {number} productId The ID of the product that should be loaded from the shopping cart
 *
 * @returns {(ShoppingCartItem|undefined)} Gets a product from the shopping cart. Undefined if the item does not exist.
 */
function getItemFromShoppingCart(productId) {
    const shoppingCart = getShoppingCart();
    return shoppingCart[`${productId}`]
}

/**
 * Adds an item to the shopping cart.
 *
 * @param {number} productId The ID of the product
 * @param {string} productName The name of the product
 * @param {number} productPrice The price of a single product
 * @param {number} quantity The quantity of the product
 */
function addToShoppingCart(productId, productName, productPrice, quantity) {
    const cartItem = getItemFromShoppingCart(productId) ?? {productName, productPrice, quantity: 0};
    cartItem.quantity += quantity;
    const shoppingCart = getShoppingCart();
    shoppingCart[`${productId}`] = cartItem;
    localStorage.setItem("shopping-cart", JSON.stringify(shoppingCart));
}

/**
 * Removes a product from the shopping cart
 *
 * @param {string} productId The ID of the product
 */
function removeFromShoppingCart(productId) {
    const shoppingCart = getShoppingCart();
    delete shoppingCart[productId];
    localStorage.setItem("shopping-cart", JSON.stringify(shoppingCart));
    renderShoppingCart();
}

/**
 * Renders the shopping cart into the table and calculates the final total prices.
 */
function renderShoppingCart() {
    const tableBody = document.getElementById("shoppingCartTBody");
    tableBody.innerHTML = '';
    const shoppingCart = getShoppingCart();
    for (const [productId, shoppingCartItem] of Object.entries(shoppingCart)) {
        const row = document.createElement("tr");

        const nameTd = document.createElement("td");
        nameTd.textContent = shoppingCartItem.productName;
        row.appendChild(nameTd);

        const quantityTd = document.createElement("td");
        quantityTd.textContent = `${shoppingCartItem.quantity}`;
        row.appendChild(quantityTd);

        const priceId = document.createElement("td");
        priceId.classList.add("price-field");
        priceId.textContent = `${getTotalPrice(shoppingCartItem.productPrice).toFixed(2)}€`;
        row.appendChild(priceId);

        const priceFullId = document.createElement("td");
        priceFullId.classList.add("price-field");
        priceFullId.textContent = `${getTotalPrice(shoppingCartItem.productPrice*shoppingCartItem.quantity).toFixed(2)}€`;
        row.appendChild(priceFullId);

        const actionsTd = document.createElement("td");
        const removeButton = document.createElement("button");
        removeButton.textContent = 'entfernen.';
        removeButton.className = "btn btn-sm danger";
        removeButton.addEventListener("click", () => removeFromShoppingCart(productId));
        actionsTd.appendChild(removeButton);
        row.appendChild(actionsTd);

        tableBody.appendChild(row);
    }
    const priceWoTax = getPriceWOTax(shoppingCart);
    document.getElementById('priceWOTax').innerHTML = `Gesamt (ohne Steuern): <span class="price-field">${priceWoTax.toFixed(2)}</span>`;
    document.getElementById('priceWITax').innerHTML = `Gesamt (inkl. 19%): <span class="price-field">${getTotalPrice(priceWoTax).toFixed(2)}</span>`;

    // Update all prices afterward
    updatePrices();
}


/**
 * Calculates the price without tax.
 *
 * @param {Record<string, ShoppingCartItem>} shoppingCart The shopping cart
 * @returns {number} The total price without tax
 */
function getPriceWOTax(shoppingCart) {
    let totalPrice = 0;
    for (const shoppingCartItem of Object.values(shoppingCart)) {
        totalPrice += shoppingCartItem.productPrice * shoppingCartItem.quantity;
    }
    return totalPrice;
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