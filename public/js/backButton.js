const backButton = document.getElementById("backButton");
if (backButton) {
    backButton.addEventListener("click", function (e){

        if(window.history.length > 2){ //Wenn Historie > 2
            window.history.back(); //Zum vorherigen Dokument springen
            e.preventDefault() //default Weiterleitung vermeiden
        }
    });
}