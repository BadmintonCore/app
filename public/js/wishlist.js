/*Autor(en): Lasse Hoffmann*/

const wishlistButtonEmpty = document.getElementById('addToWishlistButtonEmpty');
const wishlistButtonFilled = document.getElementById('addToWishlistButtonFilled');

if (wishlistButtonEmpty) {
    wishlistButtonEmpty.addEventListener("click", function () {
        wishlistButtonEmpty.style.display = "none";
        wishlistButtonFilled.style.display = "flex";
    });
}

if (wishlistButtonFilled) {
    wishlistButtonFilled.addEventListener("click", function () {
        wishlistButtonFilled.style.display = "none";
        wishlistButtonEmpty.style.display = "flex";
    });
}

// Lädt den passenden Button-Zustand beim Seitenaufruf je nachdem, ob das Produkt auf der Wunschliste ist
function loadWishlistButton() {
    const searchParams = new URLSearchParams(location.search);
    if (wishlistButtonEmpty && wishlistButtonFilled) {
        if (isWishlist(searchParams.get('itemId'))) {
            wishlistButtonFilled.style.display = "flex";
            wishlistButtonEmpty.style.display = "none";
        } else {
            wishlistButtonEmpty.style.display = "flex";
            wishlistButtonFilled.style.display = "none";
        }
    }
}

// Prüft, ob ein bestimmtes Produkt auf der Wunschliste ist
function isWishlist(productId) {
    return getItemFromWishlist(productId) !== undefined;
}

/**
 * JSDoc-Typdefinition für ein Wunschlisten-Element.
 *
 * @typedef {Object} WishlistItem
 * @property {string} productName Der Name des Produkts
 * @property {number} productPrice Der Preis des Produkts
 * @property {number} quantity Die Anzahl des Produkts
 */

/**
 * Holt die Wunschliste aus dem localStorage des Browsers.
 *
 * @returns {Record<string, WishlistItem>}
 */
function getWishlist() {
    const rawWishlistContent = localStorage.getItem("wishlist") ?? '{}';
    return JSON.parse(rawWishlistContent);
}

/**
 * Holt ein Produkt aus der Wunschliste im localStorage.
 *
 * @param {number} productId Die ID des Produkts, das geladen werden soll
 *
 * @returns {(WishlistItem|undefined)} Gibt ein Produkt der Wunschliste zurück oder undefined, wenn es nicht existiert
 */
function getItemFromWishlist(productId) {
    const wishlist = getWishlist();
    return wishlist[`${productId}`]
}

/**
 * Fügt ein Produkt der Wunschliste hinzu.
 *
 * @param {number} productId Die ID des Produkts
 * @param {string} productName Der Name des Produkts
 * @param {number} productPrice Der Preis eines einzelnen Produkts
 */
function addToWishlist(productId, productName, productPrice) {
    const wishlistItem = getItemFromWishlist(productId) ?? {productName, productPrice};
    wishlistItem.addedDate = new Date().toISOString();
    const Wishlist = getWishlist();
    Wishlist[`${productId}`] = wishlistItem;
    localStorage.setItem("wishlist", JSON.stringify(Wishlist));
}

/**
 * Entfernt ein Produkt aus der Wunschliste.
 *
 * @param {number} productId Die ID des Produkts
 */
function removeFromWishlist(productId) {
    const wishlist = getWishlist();
    delete wishlist[productId];
    localStorage.setItem("wishlist", JSON.stringify(wishlist));
    renderWishlist();
}

/**
 * Berechnet den Gesamtpreis inklusive Mehrwertsteuer.
 *
 * @param {number} price Der Preis ohne Mehrwertsteuer
 * @returns {number} Der Preis inklusive Mehrwertsteuer
 */
function getTotalPrice(price) {
    return price * 1.19;
}

/**
 * Rendert die Wunschliste in die Tabelle und berechnet die endgültigen Gesamtpreise.
 */
function renderWishlist() {
    const tableBody = document.getElementById("WishlistTBody");
    tableBody.innerHTML = '';
    const wishlist = getWishlist();
    for (const [productId, wishlistItem] of Object.entries(wishlist)) {
        const row = document.createElement("tr");

        const nameTd = document.createElement("td");
        nameTd.textContent = wishlistItem.productName;
        row.appendChild(nameTd);

        const priceId = document.createElement("td");
        priceId.classList.add("price-field");
        priceId.textContent = `${getTotalPrice(wishlistItem.productPrice).toFixed(2)}€`;
        row.appendChild(priceId);

        // Neue Spalte für das Hinzufügedatum (nur Datum ohne Uhrzeit)
        const dateAddedTd = document.createElement("td");
        const dateAdded = new Date(wishlistItem.addedDate);
        // Formatierung des Datums (nur TT.MM.JJJJ)
        dateAddedTd.textContent = `${("0" + dateAdded.getDate()).slice(-2)}.${("0" + (dateAdded.getMonth() + 1)).slice(-2)}.${dateAdded.getFullYear()}`;
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
/*Autor(en): Lasse Hoffmann*/