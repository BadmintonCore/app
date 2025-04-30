/*Author: Lasse Hoffmann*/

const currencyDropdown = document.getElementById('currency');
let lastCurrency = currencyDropdown.value;

function convertCurrency(lastCurrency, newCurrency, price) {
    if(lastCurrency === 'EUR'){
        if(newCurrency === 'USD') {
            return price * 1.19;
        } else if (newCurrency === 'CHF') {
            return price * 0.95;
        }
    } else if (lastCurrency === 'USD') {
        if(newCurrency === 'EUR') {
            return price / 1.19;
        } else if (newCurrency === 'CHF') {
            return price * 1.19;
        }
    } else if (lastCurrency === 'CHF') {
        if(newCurrency === 'EUR') {
            return price / 0.95;
        } else if (newCurrency === 'USD') {
            return price / 1.19;
        }
    }
}

currencyDropdown.addEventListener('change', () => {
    const newCurrency = currencyDropdown.value;
    convertCurrency(lastCurrency, newCurrency, 55.00);
    lastCurrency = newCurrency
});

/*Author: Lasse Hoffmann*/