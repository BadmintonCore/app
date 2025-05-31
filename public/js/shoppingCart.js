const addToCartButton = document.getElementById('addToCartButton');
const sizeRadios = document.querySelectorAll('input[name="size"]');
const colorRadios = document.querySelectorAll('input[name="color"]');

addToCartButton.addEventListener("click", (e) => {
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
});
