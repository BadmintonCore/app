/*Autor(en): Lennart Moog*/
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
/*Autor(en): Lennart Moog*/