/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
function cookiesEnabled() {
    // Versuche ein Test-Cookie zu setzen
    document.cookie = "testcookie=1";
    return document.cookie.indexOf("testcookie") !== -1;
}

document.addEventListener("DOMContentLoaded", function () {
    if (!cookiesEnabled()) {
        const warningBox = document.getElementById("cookie-warning");
        const footer = document.querySelector("footer");
        if (warningBox && footer) {
            //Cookie-Warnung anzeigen und Footer ausblenden
            warningBox.style.display = "block";
            footer.style.display = "none";
        }
    } else {
        // Test-Cookie wieder löschen
        document.cookie = "testcookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
});