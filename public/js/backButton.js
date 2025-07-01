/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

const backButton = document.getElementById("backButton");
if (backButton) {
    backButton.addEventListener("click", function(e) {
        e.preventDefault(); // Verhindert, dass "#" anspringt oder die Seite neu lädt
        window.history.back(); // Geht im Verlauf eine Seite zurück
    });
}
