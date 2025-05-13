/*Author: Lasse Hoffmann*/

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

const lastTextNumber = greetingTexts.length + 1;

/**
 * Generiert ein zufälliges Emoji aus dem Array "emojiArray"
 */
function randomizeText() {
    const min = 0; //Intervall-Anfang, dieser Wert beginnt immer bei 0 - [0, x[
    const max = greetingTexts.length; //Intervall-Ende, dieser Wert ist ausgeschlossen - [0, x[

    /*Berechnet eine zufällige Zahl in dem angegebenen Intervall [min, max[,
    Math.floor rundet eine Zahl immer ab, damit die Wahrscheinlichkeit nicht manipuliert wird*/
    do {
    var randomTextNumber = Math.floor(Math.random() * (max - min)) + min;
    } while (randomTextNumber === lastTextNumber);

    return greetingTexts[randomTextNumber];
}

/**
 * "Malt" ein zufällig generierten Text in das dafür vorgesehene Feld im Benutzerbereich
 */
function writeText() {
    const emojiField = document.getElementById('welcomeTextField');
    emojiField.innerHTML = randomizeText();
}

document.addEventListener("DOMContentLoaded", writeText);

/*Author: Lasse Hoffmann*/