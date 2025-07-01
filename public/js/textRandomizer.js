/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

const greetingTexts = [
    'Hallo,',
    'Hi,',
    'Hey,',
    'Servus,',
    'Moin,',
    'Grüß dich,',
    'Schön dich zu sehen,',
    'Willkommen,',
    'Hallöchen,',
    'Hey du,',
    'Yo,',
    'Ahoi,',
    'Sei gegrüßt,',
    'Peace,',
    'Hey hey,',
    'Nice dich zu sehen,',
    'Yooo,',
    'Heeey,',
    'Na du,',
    'Huhu,',
    'Hola,',
    'Ciao,',
    'Bonjour,',
    'Wazzup,',
    'Heyho,',
    'Hallihallo,',
    'Heeeey,',
    'Herzlich willkommen,',
    'Howdy,'
];

/**
 * Generiert einen zufälligen Text aus dem Array "greetingTexts"
 */
function randomizeText() {
    const min = 0; //Intervall-Anfang, dieser Wert beginnt immer bei 0 - [0, x[
    const max = greetingTexts.length; //Intervall-Ende, dieser Wert ist ausgeschlossen - [0, x[

    /*Berechnet eine zufällige Zahl in dem angegebenen Intervall [min, max[,
    Math.floor rundet eine Zahl immer ab, damit die Wahrscheinlichkeit nicht manipuliert wird*/
    return greetingTexts[Math.floor(Math.random() * (max - min)) + min];
}