/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
document.addEventListener("DOMContentLoaded", function () {
    const noscriptWarning = document.getElementById("noscript-warning");
    if (noscriptWarning) {
        // Verstecke die Fehlermeldung, da JavaScript aktiviert ist
        noscriptWarning.style.display = "none";
    }
});