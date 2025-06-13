document.addEventListener("DOMContentLoaded", function () {
    const noscriptWarning = document.getElementById("noscript-warning");
    if (noscriptWarning) {
        // Verstecke die Fehlermeldung, da JavaScript aktiviert ist
        noscriptWarning.style.display = "none";
    }
});