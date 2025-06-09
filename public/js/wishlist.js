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
async function isWishlist(productId) {
    const wishlist = await getWishlist();
    return wishlist.find(function (item) {
        return item.productTypeId === productId;
    }) !== undefined;
}

/**
 * JSDoc-Typdefinition für ein Wunschlisten-Element.
 *
 * @typedef {Object} WishlistItem
 * @property {string} name Der Name des Produkts
 * @property {number} price Der Preis des Produkts
 * @property {number} quantity Die Anzahl des Produkts
 */

async function getWishlist() {
    try {
        const response = await fetch('/user-area/wishlist/getWishlist', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            console.error("Fehler beim Laden der Wunschliste:", response.statusText);
            return [];
        }

        const data = await response.json();
        return Array.isArray(data) ? data : [];
    } catch (error) {
        console.error("Fehler beim Abrufen der Wunschliste:", error);
        return [];
    }
}

/**
 * Fügt ein Produkt der Wunschliste hinzu.
 *
 * @param {number} productId Die ID des Produkts
 */
async function addToWishlist(productId) {
    await fetch('/user-area/wishlist/addToWishlist', {
        method: 'POST',
        body: JSON.stringify({productTypeId:productId}),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    await renderWishlist();
}

/**
 * Entfernt ein Produkt aus der Wunschliste.
 *
 * @param {string} productId Die ID des Produkts
 */
async function removeFromWishlist(productId) {
    await fetch('/user-area/wishlist/removeFromWishlist', {
        method: 'POST',
        body: JSON.stringify({productTypeId:productId}),
        headers: {
            'Content-Type': 'application/json'
        }
    });
    await renderWishlist();
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
async function renderWishlist() {
    const tableBody = document.getElementById("WishlistTBody");
    tableBody.innerHTML = '';
    const wishlist = await getWishlist();
    for (const wishlistItem of wishlist) {
        const row = document.createElement("tr");

        const nameTd = document.createElement("td");
        nameTd.textContent = wishlistItem.name;
        row.appendChild(nameTd);

        const priceId = document.createElement("td");
        priceId.classList.add("price-field");
        priceId.textContent = `${getTotalPrice(wishlistItem.price).toFixed(2)}€`;
        row.appendChild(priceId);

        // Neue Spalte für das Hinzufügedatum (nur Datum ohne Uhrzeit)
        const dateAddedTd = document.createElement("td");
        const dateAdded = new Date(wishlistItem.timestamp);
        // Formatierung des Datums (nur TT.MM.JJJJ)
        dateAddedTd.textContent = `${("0" + dateAdded.getDate()).slice(-2)}.${("0" + (dateAdded.getMonth() + 1)).slice(-2)}.${dateAdded.getFullYear()}`;
        row.appendChild(dateAddedTd);

        // Neue Spalte für die Navigation zum Produkt
        const goToTd = document.createElement("td");
        const goToProductButton = document.createElement("td");
        goToProductButton.textContent = "ansehen.";
        goToProductButton.className = "btn btn-sm";
        goToProductButton.addEventListener("click", () => {
            window.location.href = "/categories/product?itemId=" + wishlistItem.productTypeId;
        });
        goToTd.appendChild(goToProductButton);
        row.appendChild(goToTd);


        const removeTd = document.createElement("td");
        const removeButton = document.createElement("button");
        removeButton.textContent = 'entfernen.';
        removeButton.className = "btn btn-sm danger";
        removeButton.addEventListener("click", () => {
            removeFromWishlist(wishlistItem.productTypeId);
        });
        removeTd.appendChild(removeButton);
        row.appendChild(removeTd);

        tableBody.appendChild(row);
    }
    updatePrices();
}

document.addEventListener("DOMContentLoaded", loadWishlistButton);
/*Autor(en): Lasse Hoffmann*/