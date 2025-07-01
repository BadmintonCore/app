/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

// Zugriff auf das <html>-Element (wird genutzt, um das data-theme-Attribut zu setzen)
const html = document.documentElement;


/*Aktiviert das helle Theme*/
function setLightTheme() {
    html.setAttribute('data-theme', ''); // Leeres Attribut = Standard-/Light-Theme
    localStorage.setItem('theme', 'light'); // Speichere Auswahl im Browser
}

/* Aktiviert das dunkle Theme.*/
function setDarkTheme() {
    html.setAttribute('data-theme', 'dark'); // Dunkles Theme aktivieren
    localStorage.setItem('theme', 'dark'); // Speichere Auswahl im Browser
}

/*Umschalten zwischen Hell und Dunkel*/
function toggleDarkMode() {
    const currentTheme = html.getAttribute('data-theme'); // Aktuelles Theme auslesen
    if (currentTheme === 'dark') {
        setLightTheme(); // Wenn aktuell dunkel, dann zu hell wechseln
    } else {
        setDarkTheme(); // Sonst zu dunkel wechseln
    }
}

/**
 * Wird beim Laden der Seite aufgerufen.
 * Liest das zuletzt gespeicherte Theme aus dem localStorage
 * und setzt es entsprechend.
 */
function setStartTheme() {
    const savedTheme = localStorage.getItem('theme'); // Lese gespeichertes Theme
    if (savedTheme === 'dark') {
        setDarkTheme(); // Dunkel aktivieren, wenn so gespeichert
    } else if (savedTheme === 'light') {
        setLightTheme(); // Hell aktivieren, wenn so gespeichert
    }
}

// Ruft die Startfunktion auf, sobald das Skript geladen wird
// Dadurch wird beim ersten Laden das gespeicherte Theme angewendet
setStartTheme();

document.addEventListener("DOMContentLoaded", function (e) {
    const darkModeButton = document.getElementById('darkModeToggle');
    darkModeButton.addEventListener('click', toggleDarkMode);
});