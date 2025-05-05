/*Author: Lasse Hoffmann, Mathis Burger*/


const currencyDropdown = document.getElementById('currency');

// Die zuletzt ausgewähle Währung (wird benötigt für Rückrechnung auf EUR)
let lastCurrency = "EUR";

// Die aktuell ausgewählte Währung
let currentCurrency = currencyDropdown.value;

// Die aktuellen Forex-Kurse
let currencyRates = {};

// Mapping object for all currency symbols (ISO 4217)
const currencySymbolMap = {
    EUR: '€',
    USD: '$',
    CHF: 'CHF'
}

/**
 * Converts a specific price to the current currency.
 * NOTE: First it is converted back to EUR and then to the new currency
 *
 * @param price The price that should be converted
 * @returns {number} The new price in new currency
 */
function convertCurrency(price) {
    if (currentCurrency === "EUR" && lastCurrency === "EUR") {
        return price;
    }
    // If no value present, the default value is 1 for EUR
    const priceInEur = price / (currencyRates[lastCurrency] ?? 1);
    if (currentCurrency === "EUR") {
        return priceInEur;
    }
    return priceInEur * currencyRates[currentCurrency];
}

/**
 * Calls the forex exchange API to get current currency exchange rates and sets currencyRates variable.
 *
 * @returns {Promise<void>}
 */
async function getCurrencyRates() {
    const resp = await fetch('https://api.frankfurter.app/latest?from=EUR&to=USD,CHF');
    if (resp.ok) {
        const jsonData = await resp.json();
        currencyRates = jsonData.rates;
    }
}

/**
 * Updates all prices in the current document (All elements that have "price-field" class)
 */
function updatePrices() {
    for (const priceField of document.getElementsByClassName("price-field")) {
        const priceString = priceField.childNodes[0].nodeValue;
        const price = parseFloat(priceString);
        priceField.childNodes[0].nodeValue = `${convertCurrency(price).toFixed(2)} ${currencySymbolMap[currentCurrency]}`;
    }
}

// Updates prices and sets new currency in localStorage as well as lastCurrency and currentCurrency
currencyDropdown.addEventListener('change', (e) => {
    lastCurrency = currentCurrency;
    currentCurrency = e.target.value;
    localStorage.setItem("currency", e.target.value);
    updatePrices();
});

// Initial loading of forex exchange rates and initial currency if stored in localStorage. Also updates prices in current document on initial load
document.addEventListener("DOMContentLoaded", () => {
    const storedCurrency = localStorage.getItem("currency") ?? "EUR";
    currencyDropdown.value = storedCurrency;
    currentCurrency = storedCurrency;
    getCurrencyRates().then(() => {
        updatePrices();
    });

});

/*Author: Lasse Hoffmann, Mathis Burger*/