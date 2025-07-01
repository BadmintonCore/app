/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
const inviteButton = document.getElementById("inviteButton");

if (inviteButton !== null) {
    inviteButton.addEventListener("click", (e) => {
        /**
         *
         * @type {HTMLButtonElement}
         */
        const secretTarget = e.target;
        const secret = secretTarget.getAttribute("inviteSecret");
        const accId = secretTarget.getAttribute("accId");
        const cartNumber = secretTarget.getAttribute("cartNumber");
        const link = `${location.origin}/user-area/shoppingCarts/invite?secret=${secret}&accId=${accId}&cartNumber=${cartNumber}`;
        window.navigator.clipboard.writeText(link);
        alert("Erfolgreich kopiert.")
    });
}