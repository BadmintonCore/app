/*Autor(en): Lasse Hoffmann*/

/**
 * JSDoc-Typdefinition für ein Wunschlisten-Element.
 *
 * @typedef {Object} WishlistItem
 * @property {string} name Der Name des Produkts
 * @property {float} price Der Preis des Produkts
 * @property {String} timestamp Zeitpunkt, an dem das Produkt zur Wunschliste hinzugefügt wurde
 */

// Herz-Button, der auf der Item-Seite angezeigt wird, wenn ein Produkt nicht in der Wunschliste ist
const wishlistButtonEmpty = document.getElementById('addToWishlistButtonEmpty');

// Herz-Button, der auf der Item-Seite angezeigt wird, wenn ein Produkt bereits in der Wunschliste ist
const wishlistButtonFilled = document.getElementById('addToWishlistButtonFilled');

// Event-Listener für den Fall, dass gerade das leere Herz-Icon auf der Item-Seite zu sehen ist
if (wishlistButtonEmpty) {
    wishlistButtonEmpty.addEventListener("click", function () {
        wishlistButtonEmpty.style.display = "none";
        wishlistButtonFilled.style.display = "flex";
    });
}

// Event-Listener für den Fall, dass gerade das ausgefüllte Herz-Icon auf der Item-Seite zu sehen ist
if (wishlistButtonFilled) {
    wishlistButtonFilled.addEventListener("click", function () {
        wishlistButtonFilled.style.display = "none";
        wishlistButtonEmpty.style.display = "flex";
    });
}

// Lädt die Wishlist-Buttons, sobald das DOM geladen ist
document.addEventListener("DOMContentLoaded", loadWishlistButton);

/**
 * Lädt den passenden Button-Zustand beim Seitenaufruf je nachdem, ob das Produkt auf der Wunschliste ist
 *
 * @returns {Promise<void>}
 */
async function loadWishlistButton() {

    //Parameter aus der URL lesen
    const params = new URLSearchParams(window.location.search);

    if (wishlistButtonEmpty && wishlistButtonFilled) {

        // Wenn das aktuelle Element (ItemId aus der URL gelesen) in der Wunschliste ist, dann ...
        if (await isWishlist(params.get("itemId"))) {
            wishlistButtonFilled.style.display = "flex";
            wishlistButtonEmpty.style.display = "none";
        } else {
            wishlistButtonEmpty.style.display = "flex";
            wishlistButtonFilled.style.display = "none";
        }
    }
}

/**
 * Lädt die aktuelle Wunschliste eines Benutzers mit der fetch-API
 *
 * @returns {Promise<any|*[]>}
 */
async function getWishlist() {
    try {

        // Ruft die API auf, um die Wunschliste zu erhalten
        const response = await fetch('/user-area/wishlist/getWishlist', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });

        // Wenn beim Laden ein Fehler aufgetreten ist
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
 * Prüft, ob ein bestimmtes Produkt in der Wunschliste vorhanden ist
 *
 * @param productTypeId Die ProdukttypID, nach der in der Wunschliste gesucht werden soll
 * @returns {Promise<boolean>}
 */
async function isWishlist(productTypeId) {
    const wishlist = await getWishlist();

    // Mit der Find-Funktion durchsuchen wir das Array, ob die der Produkttyp bereits in der Wunschliste vorkommt
    return wishlist.find(function (item) {
        return String(item.productTypeId) === String(productTypeId);
    }) !== undefined;
}

/**
 * Fügt ein Produkt der Wunschliste hinzu
 *
 * @param {number} productTypeId Die ProdukttypID
 */
async function addToWishlist(productTypeId) {

    // Ruft die API auf, um ein Element zur Wunschliste hinzuzufügen
    await fetch('/user-area/wishlist/addToWishlist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            productTypeId: productTypeId
        })
    });
    await renderWishlist();
}

/**
 * Entfernt ein Produkt aus der Wunschliste
 *
 * @param {string} productTypeId Die ProdukttypID
 */
async function removeFromWishlist(productTypeId) {

    // Ruft die API auf, um ein Element aus der Wunschliste zu entfernen
    await fetch('/user-area/wishlist/removeFromWishlist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            productTypeId: productTypeId
        })
    });
    await renderWishlist();
}

/**
 * Rendert die Wunschliste in die Tabelle und berechnet die Preise der ausgewählten Währung
 *
 * @returns {Promise<void>}
 */
async function renderWishlist() {
    const tableBody = document.getElementById("WishlistTBody");
    tableBody.innerHTML = '';
    const wishlist = await getWishlist();

    // Sortiert die Wunschliste nach Datum (neuste zuerst)
    wishlist.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));

    if (wishlist.length === 0) {
        //Eine durchgängige Zeile erstellen, wenn Wunschliste leer ist
        const row = document.createElement("tr");
        const cell = document.createElement("td");
        cell.textContent = "Deine Wunschliste ist leer.";
        cell.style.fontWeight = "bold";
        cell.colSpan = 5; // Anzahl der Spalten (anpassen, falls sich Spaltenanzahl ändert)
        row.appendChild(cell);
        tableBody.appendChild(row);
    } else {
        for (const wishlistItem of wishlist) {
            const row = document.createElement("tr");

            // Neue Spalte für den Namen des Produkts
            const nameTd = document.createElement("td");
            nameTd.textContent = wishlistItem.name;
            row.appendChild(nameTd);

            // Neue Spalte für den Preis des Produkts
            const priceId = document.createElement("td");
            priceId.classList.add("price-field");
            priceId.textContent = `${(wishlistItem.price).toFixed(2)}€`;
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

            // Neue Spalte, um das Produkt zu entfernen
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

    }
    updatePrices();
}

/*Autor(en): Lasse Hoffmann*/