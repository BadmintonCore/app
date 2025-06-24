/*Autor(en): Lasse Hoffmann, Mathis Burger*/

const currencyDropdown = document.getElementById('currency');

// Die zuletzt ausgewählte Währung (wird benötigt für Rückrechnung auf EUR)
let lastCurrency = "EUR";

// Die aktuell ausgewählte Währung
let currentCurrency = currencyDropdown.value;

// Die aktuellen Forex-Kurse
let currencyRates = {};

// Mapping-Objekt für alle Währungssymbole (ISO 4217)
const currencySymbolMap = {
    EUR: '€',
    USD: '$',
    CHF: 'CHF',
    KBP: '🥙'
}

/**
 * Konvertiert einen bestimmten Preis in die aktuell ausgewählte Währung.
 * HINWEIS: Zuerst wird der Preis zurück in EUR umgerechnet und dann in die neue Währung umgerechnet.
 *
 * @param priceInEur Der zu konvertierende Preis
 * @returns {number} Der neue Preis in der neuen Währung
 */
function convertCurrency(priceInEur) {
    if (currentCurrency === "EUR") {
        return priceInEur;
    }
    return priceInEur * (currencyRates[currentCurrency] ?? 1);
}

/**
 * Ruft die Forex-API auf, um aktuelle Wechselkurse zu erhalten, und setzt die Variable currencyRates.
 *
 * @returns {Promise<void>}
 */
async function getCurrencyRates() {
    const resp = await fetch('/system/exchangeRates');
    if (resp.ok) {
        const jsonData = await resp.json();
        jsonData.rates.KBP = (1/7);
        currencyRates = jsonData.rates;
    }
}

/**
 * Aktualisiert alle Preise im aktuellen Dokument (alle Elemente mit der Klasse "price-field")
 */
function updatePrices() {
    let orderButton = document.getElementById("orderButton")
    let addToCartButton = document.getElementById("addToCartButton")
    let payButton = document.getElementById("payButton");

    for (const priceField of document.getElementsByClassName("price-field")){
        const price = parseFloat(priceField.dataset.priceEur.valueOf());
        let kebapConvert = false;
        if (lastCurrency === "KBP"){
            // Preis wird aus dem HTML-Attribut (data-price-eur) gelesen und entspricht dem Euro-Wert
            lastCurrency = "EUR"
            // Damit lastCurrency nach einem Durchlauf wieder auf KBP gesetzt werden kann
            kebapConvert = true;
        }
        if (currentCurrency === "EUR" || currentCurrency === "KBP" || currentCurrency === "CHF") {
            priceField.childNodes[0].nodeValue = `${convertCurrency(price).toFixed(2).replace('.', ',')} ${currencySymbolMap[currentCurrency]}`;
        } else {
            priceField.childNodes[0].nodeValue = `${convertCurrency(price).toFixed(2)} ${currencySymbolMap[currentCurrency]}`;
        }

        if(kebapConvert){
            // Setzt lastCurrency wieder auf Kebap für den nächsten Durchlauf
            lastCurrency = "KBP";
        }
    }
    for (const feeField of document.getElementsByClassName("fee-field")){
        if (currentCurrency === "EUR" || currentCurrency === "USD" || currentCurrency === "CHF") {
            feeField.innerHTML = "&nbsp;inkl. 19% MwSt.";
        } else {
            feeField.innerHTML = "&nbsp;inkl. 19% Fleisch";
        }
    }

    if(currentCurrency === "KBP"){
        if (orderButton) {
            orderButton.disabled = true;
        }
        if (addToCartButton) {
            addToCartButton.disabled = true;
        }
        if (payButton) {
            payButton.disabled = true;
        }
    } else {
        if (orderButton) {
            orderButton.disabled = false;
        }
        if (addToCartButton) {
            addToCartButton.disabled = false;
        }
        if (payButton) {
            payButton.disabled=false;
        }
    }
}

// Aktualisiert die Preise und speichert die neue Währung in localStorage sowie in lastCurrency und currentCurrency
currencyDropdown.addEventListener('change', (e) => {
    lastCurrency = currentCurrency;
    currentCurrency = e.target.value;
    localStorage.setItem("currency", e.target.value);
    updatePrices();
});

// Initiales Laden der Wechselkurse und der gespeicherten Währung aus dem localStorage (falls vorhanden).
// Aktualisiert außerdem beim Laden der Seite alle Preise im Dokument.
document.addEventListener("DOMContentLoaded", () => {
    const storedCurrency = localStorage.getItem("currency") ?? "EUR";
    currencyDropdown.value = storedCurrency;
    currentCurrency = storedCurrency;
    getCurrencyRates().then(() => {
        for (const priceField of document.getElementsByClassName("price-field")) {
            const priceString = priceField.childNodes[0].nodeValue;
            let price = parseFloat(priceString.replace(',', '.'));
            priceField.dataset.priceEur = price; // speichere Original-EUR-Wert
        }
        updatePrices();
    });

});

/*Autor(en): Lasse Hoffmann, Mathis Burger*/