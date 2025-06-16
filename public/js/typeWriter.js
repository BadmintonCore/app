document.addEventListener("DOMContentLoaded", function() {
    const text = ["Herzlich Willkommen bei vestis.", "Shoppe jetzt unsere Bestseller!"];
    const element = document.getElementById("typeWriter");
    let i = 0;
    let textIndex = 0;
    let statusDelete = false;

    function typeWriter() {

        const currentText = text[textIndex]; // zu schreibender Text basierend auf dem Index

        // Wenn statusDelete falsch ist, wird der Text geschrieben
        if (!statusDelete) {
            if (i < currentText.length) {
                element.textContent += currentText.charAt(i);
                i++;
                setTimeout(typeWriter, getRandomTimeout());
            } else {
                statusDelete = true;
                setTimeout(typeWriter, 1000); // Pause von 1 Sekunde bevor gelöscht wird
            }
        }
        // Wenn statusDelete wahr ist, wird der Text gelöscht
        else {
            if (i > 0) {
            element.textContent = currentText.substring(0, i - 1) || "\u00A0"; // Löscht das letzte Zeichen, oder zeigt ein Leerzeichen an, wenn der Text leer ist
            i--;
            setTimeout(typeWriter, getRandomTimeout());
        }
            else {
            statusDelete = false;
            i = 0; // Zurücksetzen des Index für den nächsten Durchlauf
            textIndex = (textIndex + 1) % 2; // Wechseln zum nächsten Text
            setTimeout(typeWriter, 100); // kurze Pause bevor neu getippt wird
        }
    }
}
    typeWriter();

    function getRandomTimeout() {
        if(!statusDelete){
            return (Math.random() * (100)) + 50; // Random Timeout zwischen 50 und 150 ms
        }
        return (Math.random()) + 25; // schnellerer Random Timeout zum Löschen

    }
    });
