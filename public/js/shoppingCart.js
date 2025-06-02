/*Autor(en): Lasse Hoffmann, Mathis Burger*/
const addToCartButton = document.getElementById('addToCartButton');
const orderButton = document.getElementById("orderButton");
const quantityContainer = document.querySelector(".quantity-container");
const sizeRadios = document.querySelectorAll('input[name="size"]');
const colorRadios = document.querySelectorAll('input[name="color"]');
const quantityLabel = document.getElementById("quantityLabel");
const amountInput = document.getElementById("amount");

const getSelectedSizeAndColor = () => {
    let sizeSelected = null;
    sizeRadios.forEach((size) => {
        if (size.checked) {
            sizeSelected = size;
        }
    });

    let colorSelected = null;
    colorRadios.forEach((color) => {
        if (color.checked) {
            colorSelected = color;
        }
    });

    return [sizeSelected, colorSelected];
}

const checkStock = async () => {

    const [sizeSelected, colorSelected] = getSelectedSizeAndColor();

    if (sizeSelected === null || colorSelected === null) {
        return;
    }

    const searchParams = new URLSearchParams(location.search);
    searchParams.set("sizeId", sizeSelected.value);
    searchParams.set("colorId", colorSelected.value);

    const resp = await fetch(`/categories/product/checkStock?${searchParams.toString()}`);
    const jsonResponse = await resp.json();
    const quantityDisplay = document.getElementById("quantityLeft");
    quantityDisplay.innerText = `${jsonResponse.quantityLeft} Stück noch im Lager`;

    if (jsonResponse.quantityLeft > 0) {
        orderButton.style.display = "block";
        addToCartButton.style.display = "block";
        quantityContainer.style.display = "block";
        quantityLabel.style.display = "block";
    } else {
        orderButton.style.display = "none";
        addToCartButton.style.display = "none";
        quantityContainer.style.display = "none";
        quantityLabel.style.display = "none";
    }

    if (jsonResponse.quantityLeft < 5) {
        quantityDisplay.classList.add("error-message");
    } else {
        quantityDisplay.classList.remove("error-message");
    }

    amountInput.max = jsonResponse.quantityLeft;
    if (amountInput.value > jsonResponse.quantityLeft) {
        amountInput.value = 1;
    }
};

for (const radio of sizeRadios) {
    radio.addEventListener("click", checkStock)
}

for (const radio of colorRadios) {
    radio.addEventListener("click", checkStock)
}


const submitListener = (e) => {
    const [sizeSelected, colorSelected] = getSelectedSizeAndColor();

    if (sizeSelected === null && colorSelected === null) {
        e.preventDefault();
        alert("Bitte Größe und Farbe auswählen, bevor du etwas in den Warenkorb legst.");
    } else if (sizeSelected === null){
        e.preventDefault();
        alert("Bitte Größe auswählen, bevor du etwas in den Warenkorb legst.");
    } else if (colorSelected === null){
        e.preventDefault();
        alert("Bitte Farbe auswählen, bevor du etwas in den Warenkorb legst.");
    }
};

addToCartButton.addEventListener("click", submitListener);
/*Autor(en): Lasse Hoffmann, Mathis Burger*/