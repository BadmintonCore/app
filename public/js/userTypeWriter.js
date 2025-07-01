/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
document.addEventListener("DOMContentLoaded", function() {
    const element = document.getElementById("userTypeWriter");
    let text = "\u00A0";
    let emoji = "";
    const name = firstname;
    let i = 0;



    function userTypeWriter() {

        text = getRandomizedText() + " " + name + "! ";
        emoji = getRandomizedEmoji();


        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(userTypeWriter, getRandomTimeout());
        }
        else{
            element.textContent += emoji; // Emoji hinzufügen, wenn der Text fertig ist

        }
    }
    userTypeWriter();


    function getRandomizedText() {
        // Holt Begrüßung aus Session oder wählt neue
        if (sessionStorage.getItem('greetingText') === null || sessionStorage.getItem('greetingText') === "") {
            const randomizedText = randomizeText();
            sessionStorage.setItem('greetingText', randomizedText);
            return randomizedText;
        } else {
            return sessionStorage.getItem('greetingText');
        }
    }


    function getRandomizedEmoji() {
        // Holt Emoji aus Session oder wählt neues
        if (sessionStorage.getItem('greetingEmoji') === null || sessionStorage.getItem('greetingEmoji') === "") {
            const randomizedEmoji = randomizeEmoji();
            sessionStorage.setItem('greetingEmoji', randomizedEmoji);
            return randomizedEmoji;
        } else {
            return sessionStorage.getItem('greetingEmoji');
        }
    }


    function getRandomTimeout() {
        return (Math.random() * (100)) + 50; // Random Timeout zwischen 50 und 150 ms

    }

});
