/*Autor(en): Lasse Hoffmann*/
const backButton = document.getElementById("backButton");
if (backButton) {
    backButton.addEventListener("click", function (e){
        const pathname = location.pathname.split('/');
        pathname.pop();
        const search = new URLSearchParams(location.search);
        // itemID standardmäßig entfernen
        search.delete("itemId");
        let href = pathname.join('/');
        if (search.size > 0) {
            href += `?${search.toString()}`
        }
        location.href = href;
    });
}
/*Autor(en): Lasse Hoffmann*/