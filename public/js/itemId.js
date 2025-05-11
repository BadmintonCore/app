/**
 * @author Mathis Burger
 */

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
    const quantity = formData.get("quantity");
    if (action === "add_to_cart" && typeof quantity === "string") {
        addToShoppingCart(1, "Tshirt", 55.00 / 1.19, parseInt(quantity, 10));
    }
}

document.getElementById("itemIdForm").addEventListener("submit", handleFormSubmit);

document.getElementById('addToWishlistButtonEmpty').addEventListener('click', function () {
    addToWishlist(1, "Tshirt", 55.00 / 1.19);
});

document.getElementById('addToWishlistButtonFilled').addEventListener('click', function () {
    removeFromWishlist(1);
});