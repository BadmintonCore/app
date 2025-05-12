
/**
 * Handles the form submission on the item ID page
 *
 * @param {SubmitEvent} e The submit event
 */
function handleFormSubmit(e) {
    e.preventDefault();
    const formData = new FormData(e.currentTarget);
    const action = e.submitter.name;
    if (action === "buy_direct") {
        alert("Direktkäufe sind noch nicht möglich");
        return;
    }
}

document.getElementById("addToCartButton").addEventListener("click", () => {
    const searchParams = new URLSearchParams(location.search);
    const productName = document.getElementById("nameText").textContent;
    const price = parseFloat(document.getElementById("priceText").textContent);
    addToShoppingCart(parseInt(searchParams.get("itemId"), 10), productName, price / 1.19, 1);
    alert("Erfolgreich zum Warenkorb hinzugefügt.")
})

document.getElementById("itemIdForm").addEventListener("submit", handleFormSubmit);

document.getElementById('addToWishlistButtonEmpty').addEventListener('click',  () => {
    const searchParams = new URLSearchParams(location.search);
    const productName = document.getElementById("nameText").textContent;
    const price = parseFloat(document.getElementById("priceText").textContent);
    addToWishlist(parseInt(searchParams.get("itemId"), 10), productName, price / 1.19);
});

document.getElementById('addToWishlistButtonFilled').addEventListener('click',  () => {
    const searchParams = new URLSearchParams(location.search);
    removeFromWishlist(parseInt(searchParams.get("itemId"), 10));
});