/*Author: Lasse Hoffmann*/
const currencyDropdown = document.getElementById('currency');
let lastCurrency = currencyDropdown.value;

var currencyRates = {};

function convertCurrency(price) {
    return price * currencyRates[lastCurrency];
}

async function getCurrencyRates() {
    const resp = await fetch('https://api.frankfurter.app/latest?from=EUR&to=USD,CHF');
    const jsonData = await resp.json();
    currencyRates = jsonData.rates;
}

function updateProductCardPrices() {
    for (const productCard of document.getElementsByClassName("product-card")) {
        const priceTag = productCard.querySelector("h4");
        const priceString = priceTag.innerText;
        const price = parseFloat(priceString);
        priceTag.innerText = convertCurrency(price);
    }
}

// Laden der Forex-Kurse bei Änderung
currencyDropdown.addEventListener('change', () => {
    const newCurrency = currencyDropdown.value;
    convertCurrency(lastCurrency, newCurrency, 55.00);
    lastCurrency = newCurrency;
    getCurrencyRates().then(() => {
        updateProductCardPrices();
    })
});

// Laden der Forex-Kurse bei init
document.addEventListener("DOMContentLoaded", () => {
    getCurrencyRates().then(() => {
        updateProductCardPrices();
    });

});

/*Author: Lasse Hoffmann*/