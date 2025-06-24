/*Autor(en): Lasse Hoffmann*/

const backButton = document.getElementById("backButton");
if (backButton) {
    backButton.addEventListener("click", function(e) {
        e.preventDefault(); // Verhindert, dass "#" anspringt oder die Seite neu lädt
        window.history.back(); // Geht im Verlauf eine Seite zurück
    });
}

/*Autor(en): Lasse Hoffmann*/