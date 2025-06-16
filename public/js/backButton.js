/*Autor(en): Lasse Hoffmann*/
// const backButton = document.getElementById("backButton");
// if (backButton) {
//     backButton.addEventListener("click", function (e){
//         const pathname = location.pathname.split('/');
//         pathname.pop();
//         const search = new URLSearchParams(location.search);
//         // itemID standardmäßig entfernen
//         search.delete("itemId");
//         let href = pathname.join('/');
//         if (search.size > 0) {
//             href += `?${search.toString()}`
//         }
//         location.href = href;
//     });
// }

const backButton = document.getElementById("backButton");
if (backButton) {
    backButton.addEventListener("click", function(e) {
        e.preventDefault(); // Verhindert, dass "#" anspringt oder die Seite neu lädt
        window.history.back(); // Geht im Verlauf eine Seite zurück
    });
}
/*Autor(en): Lasse Hoffmann*/