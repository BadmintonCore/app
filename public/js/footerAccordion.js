/*Author: Lasse Hoffmann, Quelle: https://www.w3schools.com/howto/howto_js_accordion.asp*/
const accordionElements = document.getElementsByClassName("accordion-button");

/*Für alle accordion-buttons*/
for (let i = 0; i < accordionElements.length; i++) {
    accordionElements[i].addEventListener("click", function () {

        /* Umschalten der Styles*/

        /*Das zugehörige accordion-content-Element (Container) als Variable speichern*/
        let accordionContent = this.nextElementSibling;
        if (accordionContent.style.display === "block") {

            /*Accordion-Content vertecken*/
            accordionContent.style.display = "none";

            /*Umschalten zwischen den geöffnet/geschlossen-Icon des Akkordeons*/
            accordionElements[i].querySelector(".close").style.display = "none";
            accordionElements[i].querySelector(".open").style.display = "block";
        } else {

            /*Accordion-Content zeigen*/
            accordionContent.style.display = "block";

            /*Umschalten zwischen den geöffnet/geschlossen-Icon des Akkordeons*/
            accordionElements[i].querySelector(".close").style.display = "block";
            accordionElements[i].querySelector(".open").style.display = "none";
        }
    });
}
/*Author: Lasse Hoffmann, Quelle: https://www.w3schools.com/howto/howto_js_accordion.asp*/