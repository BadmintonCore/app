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

/**
 * Generiert ein zufälliges Emoji aus dem Array "emojiArray"
 */
function randomizeText() {
    const min = 0; //Intervall-Anfang, dieser Wert beginnt immer bei 0 - [0, x[
    const max = greetingTexts.length; //Intervall-Ende, dieser Wert ist ausgeschlossen - [0, x[

    /*Berechnet eine zufällige Zahl in dem angegebenen Intervall [min, max[,
    Math.floor rundet eine Zahl immer ab, damit die Wahrscheinlichkeit nicht manipuliert wird*/
    return greetingTexts[Math.floor(Math.random() * (max - min)) + min];
}

/**
 * "Malt" ein zufällig generierten Text in das dafür vorgesehene Feld im Benutzerbereich
 */
function writeText() {
    const welcomeTextField = document.getElementById('welcomeTextField');
    if (sessionStorage.getItem('greetingText') === null || sessionStorage.getItem('greetingText') === "") {
        const randomizedText = randomizeText();
        welcomeTextField.innerHTML = randomizedText;
        sessionStorage.setItem('greetingText', randomizedText);
    } else {
        welcomeTextField.innerHTML = sessionStorage.getItem('greetingText');
    }
}

document.addEventListener("DOMContentLoaded", writeText);

/*Author: Lasse Hoffmann*/