/*Autor(en): Lasse Hoffmann*/

const greetingEmojis = [
    '😀','😃','😄','😁','😆','😅','😂','🤣','😊','😇',
    '🙂','🙃','😉','😌','😍','🥰','😘','😗','😙','😚',
    '🤗','🤩','🥳','😎','😋','😛','😜','🤪','😝','🫠',
    '😺','😸','😹','😻','😽','🙀','😼','😃','😇','🫶',
    '🤠','🫡','😏','🤤','😮‍💨','😌','😻','🤓','🧐','😸'
];

let lastEmojiNumber = greetingEmojis.length + 1;

/**
 * Generiert ein zufälliges Emoji aus dem Array "greetingEmojis"
 */
function randomizeEmoji() {
    const min = 0; // Intervall-Anfang, dieser Wert beginnt immer bei 0 - [0, x[
    const max = greetingEmojis.length; // Intervall-Ende, dieser Wert ist ausgeschlossen - [0, x[

    /*Berechnet eine zufällige Zahl in dem angegebenen Intervall [min, max[,
    Math.floor rundet eine Zahl immer ab, damit die Wahrscheinlichkeit nicht manipuliert wird*/
    return greetingEmojis[Math.floor(Math.random() * (max - min)) + min];
}


/*Autor(en): Lasse Hoffmann*/