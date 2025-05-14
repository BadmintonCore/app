/*Author: Lasse Hoffmann*/

const greetingEmojis = [
    '😀','😃','😄','😁','😆','😅','😂','🤣','😊','😇',
    '🙂','🙃','😉','😌','😍','🥰','😘','😗','😙','😚',
    '🤗','🤩','🥳','😎','😋','😛','😜','🤪','😝','🫠',
    '😺','😸','😹','😻','😽','🙀','😼','😃','😇','🫶',
    '🤠','🫡','😏','🤤','😮‍💨','😌','😻','🤓','🧐','😸'
];

const lastEmojiNumber = greetingEmojis.length + 1;

/**
 * Generiert ein zufälliges Emoji aus dem Array "emojiArray"
 */
function randomizeEmoji() {
    const min = 0; //Intervall-Anfang, dieser Wert beginnt immer bei 0 - [0, x[
    const max = greetingEmojis.length; //Intervall-Ende, dieser Wert ist ausgeschlossen - [0, x[

    /*Berechnet eine zufällige Zahl in dem angegebenen Intervall [min, max[,
    Math.floor rundet eine Zahl immer ab, damit die Wahrscheinlichkeit nicht manipuliert wird*/
    do {
        var randomEmojiNumber = Math.floor(Math.random() * (max - min)) + min;
    } while (randomEmojiNumber === lastEmojiNumber);

    return greetingEmojis[randomEmojiNumber];
}

/**
 * "Malt" ein zufällig generiertes Emoji in das dafür vorgesehene Feld im Benutzerbereich
 */
function drawEmoji() {
    const emojiField = document.getElementById('emojiField');
    emojiField.innerHTML = randomizeEmoji();
}

document.addEventListener("DOMContentLoaded", drawEmoji);

/*Author: Lasse Hoffmann*/